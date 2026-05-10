<div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-2xl transition duration-500 transform hover:-translate-y-2 group relative border border-gray-100 dark:border-gray-700" data-aos="fade-up" data-aos-delay="{{ $delay ?? 0 }}">
    <!-- Image -->
    <a href="{{ route('product.show', $product->slug) }}" class="block relative h-64 overflow-hidden">
        <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/400x400.png?text=Product' }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
        @if($product->is_featured)
            <span class="absolute top-4 right-4 bg-luxury-wood text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                مميز
            </span>
        @endif
        
        <!-- Quick Add Overlay -->
        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
            <button onclick="event.preventDefault(); document.getElementById('add-to-cart-{{ $product->id }}').submit();" class="bg-white text-luxury-black font-bold py-2 px-6 rounded-full transform translate-y-4 group-hover:translate-y-0 transition duration-300 hover:bg-luxury-wood hover:text-white shadow-lg">
                إضافة للسلة
            </button>
        </div>
    </a>
    
    <!-- Content -->
    <div class="p-6 text-right">
        <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">{{ $product->category->name ?? 'منظمات' }}</div>
        <a href="{{ route('product.show', $product->slug) }}">
            <h3 class="text-lg font-bold text-luxury-black dark:text-white mb-2 hover:text-luxury-wood transition">{{ $product->name }}</h3>
        </a>
        <div class="flex justify-between items-center mt-4 border-t border-gray-100 dark:border-gray-700 pt-4">
            <span class="text-xl font-bold text-luxury-wood">{{ number_format($product->price, 2) }} {{ \App\Models\Setting::get('store_currency', 'د.م.') }}</span>
            <div class="flex text-yellow-400 text-sm">
                @for($i = 0; $i < 5; $i++)
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                @endfor
            </div>
        </div>
    </div>

    <!-- Hidden Form for Quick Add -->
    <form id="add-to-cart-{{ $product->id }}" action="{{ route('cart.add', $product->id) }}" method="POST" class="hidden">
        @csrf
    </form>
</div>

