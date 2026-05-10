<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)->with('category')->take(6)->get();
        $categories = Category::where('is_active', true)->take(6)->get();
        
        return view('pages.home', compact('featuredProducts', 'categories'));
    }
}
