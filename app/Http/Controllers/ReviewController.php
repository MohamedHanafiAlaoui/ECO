<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'captcha' => ['required', new \App\Rules\CaptchaRule()],
        ]);

        Review::create([
            'product_id' => $productId,
            'name' => $request->name,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => true, // Auto-approve for now as requested by "premium" feel
        ]);

        return back()->with('success', 'شكراً لك! تم إضافة تقييمك بنجاح.');
    }
}
