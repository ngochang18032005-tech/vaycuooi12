<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id', 0)
                ->with('children')
                ->get();

        // Trả về view và truyền dữ liệu 'categories'
        return view('shop.category.index', compact('categories'));
    }
}
