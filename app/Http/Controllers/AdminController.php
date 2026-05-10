<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Visit;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => ['required', new \App\Rules\CaptchaRule()],
        ]);

        $throttleKey = Str::lower($request->email).'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->with('error', 'محاولات كثيرة جداً. يرجى المحاولة بعد '.$seconds.' ثانية.');
        }

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            RateLimiter::clear($throttleKey);
            
            // Session protection
            $request->session()->regenerate();
            
            session(['admin_id' => $admin->id, 'admin_name' => $admin->name]);
            
            ActivityLog::log('login', 'تم تسجيل الدخول بنجاح');
            
            return redirect()->route('admin.dashboard');
        }

        RateLimiter::hit($throttleKey);
        
        ActivityLog::log('failed_login', 'محاولة تسجيل دخول فاشلة', null, ['email' => $request->email]);

        return back()->with('error', 'بيانات الدخول غير صحيحة');
    }

    public function logout(Request $request)
    {
        ActivityLog::log('logout', 'تم تسجيل الخروج');
        
        session()->forget(['admin_id', 'admin_name']);
        
        // Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login');
    }

    public function index()
    {
        $now = now();
        $startOfMonth = $now->copy()->startOfMonth();
        $startOfLastMonth = $now->copy()->subMonth()->startOfMonth();
        $endOfLastMonth = $now->copy()->subMonth()->endOfMonth();

        // Stats calculation
        $totalSales = Order::where('status', 'completed')->sum('total_amount');
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalProducts = Product::count();

        // Growth calculations (comparing this month with last month)
        $currentMonthSales = Order::where('status', 'completed')->whereBetween('created_at', [$startOfMonth, $now])->sum('total_amount');
        $lastMonthSales = Order::where('status', 'completed')->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->sum('total_amount');
        $salesGrowth = $lastMonthSales > 0 ? (($currentMonthSales - $lastMonthSales) / $lastMonthSales) * 100 : ($currentMonthSales > 0 ? 100 : 0);

        $currentMonthOrders = Order::whereBetween('created_at', [$startOfMonth, $now])->count();
        $lastMonthOrders = Order::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();
        $ordersGrowth = $lastMonthOrders > 0 ? (($currentMonthOrders - $lastMonthOrders) / $lastMonthOrders) * 100 : ($currentMonthOrders > 0 ? 100 : 0);

        // Real Traffic Data
        $totalVisits = Visit::count();
        $pageViews = Visit::count(); // Simple count for now
        $mobileVisits = Visit::where('device', 'mobile')->count();
        $desktopVisits = Visit::where('device', 'desktop')->count();
        $tabletVisits = Visit::where('device', 'tablet')->count();
        
        $totalMobileDesktop = ($mobileVisits + $desktopVisits + $tabletVisits) ?: 1;
        
        $stats = [
            'total_sales' => $totalSales,
            'total_orders' => $totalOrders,
            'pending_orders' => $pendingOrders,
            'total_products' => $totalProducts,
            'sales_growth' => round($salesGrowth, 1),
            'orders_growth' => round($ordersGrowth, 1),
            'avg_order_value' => $totalOrders > 0 ? $totalSales / $totalOrders : 0,
            'conversion_rate' => $totalVisits > 0 ? ($totalOrders / $totalVisits) * 100 : 0,
            'visitors' => $totalVisits,
            'page_views' => $pageViews,
            'mobile_percentage' => round(($mobileVisits / $totalMobileDesktop) * 100, 1),
            'desktop_percentage' => round(($desktopVisits / $totalMobileDesktop) * 100, 1),
        ];
        
        $recentOrders = Order::latest()->take(10)->get();
        
        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }

    public function orders(Request $request)
    {
        $query = Order::query();

        // Search by order number or customer name
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('order_number', 'LIKE', "%{$q}%")
                    ->orWhere('full_name', 'LIKE', "%{$q}%");
            });
        }

        // Filter by confirmation status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by payment status
        if ($request->filled('payment')) {
            $query->where('payment_status', $request->payment);
        }

        // Filter by product (via order items)
        if ($request->filled('product')) {
            $query->whereHas('items', function($sub) use ($request) {
                $sub->where('product_id', $request->product);
            });
        }

        $orders = $query->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function products()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function productCreate()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.create', compact('categories'));
    }

    public function productStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'slug' => 'nullable|unique:products,slug',
        ]);

        $data = $request->except(['image', 'images']);
        $data['slug'] = $request->slug ?? (Str::slug($request->name) . '-' . time());
        
        if ($request->hasFile('image')) {
            $fileName = 'prod_' . Str::random(20) . '.' . $request->file('image')->getClientOriginalExtension();
            $data['image'] = $request->file('image')->storeAs('products', $fileName, 'public');
        }

        if ($request->hasFile('images')) {
            $gallery = [];
            foreach ($request->file('images') as $file) {
                $galName = 'gal_' . Str::random(20) . '.' . $file->getClientOriginalExtension();
                $gallery[] = $file->storeAs('products/gallery', $galName, 'public');
            }
            $data['images'] = $gallery;
        }

        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');

        $product = Product::create($data);
        
        ActivityLog::log('product_create', "تم إضافة منتج جديد: {$product->name}", $product);
        
        return redirect()->route('admin.products')->with('success', 'تم إضافة المنتج بنجاح');
    }

    public function productEdit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function productUpdate(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'slug' => 'required|unique:products,slug,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except(['image', 'images']);
        
        if ($request->hasFile('image')) {
            $fileName = 'prod_' . Str::random(20) . '.' . $request->file('image')->getClientOriginalExtension();
            $data['image'] = $request->file('image')->storeAs('products', $fileName, 'public');
        }

        if ($request->hasFile('images')) {
            $gallery = $product->images ?? [];
            foreach ($request->file('images') as $file) {
                $galName = 'gal_' . Str::random(20) . '.' . $file->getClientOriginalExtension();
                $gallery[] = $file->storeAs('products/gallery', $galName, 'public');
            }
            $data['images'] = $gallery;
        }

        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');

        $product->update($data);
        
        ActivityLog::log('product_update', "تم تحديث المنتج: {$product->name}", $product);
        
        return redirect()->route('admin.products')->with('success', 'تم تحديث المنتج بنجاح');
    }

    public function productDelete($id)
    {
        $product = Product::findOrFail($id);
        $productName = $product->name;
        $product->delete();
        
        ActivityLog::log('product_delete', "تم حذف المنتج: {$productName}");
        
        return back()->with('success', 'تم حذف المنتج بنجاح');
    }

    // Categories
    public function categories()
    {
        $categories = Category::withCount('products')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'is_active' => true
        ]);

        ActivityLog::log('category_create', "تم إضافة قسم جديد: {$category->name}", $category);

        return back()->with('success', 'تم إضافة القسم بنجاح');
    }

    public function categoryDelete($id)
    {
        $category = Category::findOrFail($id);
        $categoryName = $category->name;
        $category->delete();

        ActivityLog::log('category_delete', "تم حذف القسم: {$categoryName}");

        return back()->with('success', 'تم حذف القسم بنجاح');
    }

    // Orders Status
    public function orderUpdateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $oldStatus = $order->status;
        
        if ($request->has('status')) {
            $order->update(['status' => $request->status]);
            ActivityLog::log('order_status_update', "تم تغيير حالة الطلب #{$order->order_number} من {$oldStatus} إلى {$request->status}", $order);
        }
        
        if ($request->has('payment_status')) {
            $order->update(['payment_status' => $request->payment_status]);
            ActivityLog::log('order_payment_status_update', "تم تغيير حالة دفع الطلب #{$order->order_number} إلى {$request->payment_status}", $order);
        }
        
        if ($request->has('shipping_status')) {
            $order->update(['shipping_status' => $request->shipping_status]);
            ActivityLog::log('order_shipping_status_update', "تم تغيير حالة شحن الطلب #{$order->order_number} إلى {$request->shipping_status}", $order);
        }
        
        return back()->with('success', 'تم تحديث حالة الطلب');
    }

    public function editorUpload(Request $request)
    {
        if ($request->hasFile('image')) {
            $request->validate(['image' => 'image|mimes:jpeg,png,jpg,webp|max:2048']);
            $fileName = 'edit_' . Str::random(10) . '.' . $request->file('image')->getClientOriginalExtension();
            $path = $request->file('image')->storeAs('editor', $fileName, 'public');
            
            ActivityLog::log('editor_upload', 'تم رفع صورة من المحرر');
            
            return response()->json([
                'url' => asset('storage/' . $path)
            ]);
        }
        return response()->json(['error' => 'No image uploaded'], 400);
    }

    public function settings()
    {
        $settings = Setting::pluck('value', 'key');
        return view('admin.settings', compact('settings'));
    }

    public function settingsUpdate(Request $request)
    {
        $data = $request->except(['_token', 'store_logo', 'store_favicon']);
        
        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        // Handle File Uploads with Security
        if ($request->hasFile('store_logo')) {
            $request->validate(['store_logo' => 'image|mimes:jpeg,png,jpg,webp|max:2048']);
            $fileName = 'logo_' . Str::random(10) . '.' . $request->file('store_logo')->getClientOriginalExtension();
            $path = $request->file('store_logo')->storeAs('settings', $fileName, 'public');
            Setting::set('store_logo', $path);
        }

        if ($request->hasFile('store_favicon')) {
            $request->validate(['store_favicon' => 'image|mimes:jpeg,png,jpg,webp,ico|max:1024']);
            $fileName = 'fav_' . Str::random(10) . '.' . $request->file('store_favicon')->getClientOriginalExtension();
            $path = $request->file('store_favicon')->storeAs('settings', $fileName, 'public');
            Setting::set('store_favicon', $path);
        }
        
        ActivityLog::log('settings_update', 'تم تحديث إعدادات المتجر');
        
        return back()->with('success', 'تم تحديث الإعدادات بنجاح');
    }

    public function logs()
    {
        $logs = ActivityLog::with('admin')->latest()->paginate(20);
        return view('admin.logs', compact('logs'));
    }
}
