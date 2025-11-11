<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;


class HomeController extends Controller
{
    public function index(Request $request){

        // sản phẩm mới 
        $newProducts = Product::whereNull('deleted_at')->where('status', 1)->orderBy('id','desc')->take(6)->get();
        // sản phẩm sale 
        $saleProducts = Product::whereNull('deleted_at')->where('status', 1)->where('sale_price', '!=', 0)->take(6)->get();
        // sản phẩm thep view
        $viewProducts = Product::whereNull('deleted_at')->where('status', 1)->where('views', '>=', 50)->orderBy('views', 'desc')->take(6)->get();
        // tất cả sản phẩm
        $allProducts = Product::whereNull('deleted_at')->orderBy('id','desc')->paginate(12);

        $categories = Category::whereNull('deleted_at')->take(6)->get();

        $category = Category::where('parent_id', 0)->with('children')->get();

        $brandId = $request->brand_id;

        // Lấy danh sách thương hiệu để render dropdown
        $brands = Brand::where('status', 1)->get();
                
        // Lọc sản phẩm theo brand_id nếu có
        $products = Product::with('brand')
            ->when($brandId, function ($query) use ($brandId) {return $query->where('brand_id', $brandId);})->get();

        return view('shop.home.home', compact('newProducts', 'saleProducts', 
            'viewProducts', 'allProducts', 'categories', 'category', 'brands', 'products'));
    }

}