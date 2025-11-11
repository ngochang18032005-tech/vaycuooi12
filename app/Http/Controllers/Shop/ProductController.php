<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;


class ProductController extends Controller
{
    public function index()
    {
        // Lấy tất cả danh mục có sản phẩm, load luôn sản phẩm và danh mục cha
        $categories = Category::with(['parent', 'products' => function ($q) {
            $q->whereNull('deleted_at')->latest();
        }])->get();

        return view('shop.product.products', compact('categories'));
    }


    public function productsToBrand(Request $request)
    {
        $brandId = $request->brand_id;
        $brands = Brand::where('status', 1)->get();
        $selectedBrand = $brandId ? Brand::find($brandId) : null;

        // Lấy các danh mục có sản phẩm thuộc thương hiệu này
        $categories = Category::whereHas('products', function ($query) use ($brandId) {
            $query->where('brand_id', $brandId)->where('status', 1);
        })->with(['products' => function ($query) use ($brandId) {
            $query->where('brand_id', $brandId)->where('status', 1);
        }])->get();

        return view('shop.product.brand', compact('brands', 'selectedBrand', 'categories'));
    }


    public function products($type = 'new')
    {
        // Sản phẩm mới
        if ($type == 'new') {
            $products = Product::whereNull('deleted_at')->where('status', 1)
                ->orderBy('id', 'desc')
                ->get();
            $title = 'Tất cả sản phẩm mới';
        }
        // Sản phẩm sale
        elseif ($type == 'sale') {
            $products = Product::whereNull('deleted_at')->where('status', 1)
                ->where('sale_price', '!=', 0)
                ->get();
            $title = 'Tất cả sản phẩm sale';
        }
        // Sản phẩm hot (theo lượt xem)
        elseif ($type == 'hot') {
            $products = Product::whereNull('deleted_at')->where('status', 1)->where('views', '>=', 50)
                ->orderBy('views', 'desc')
                ->get();
            $title = 'Tất cả sản phẩm hot';
        }
        else {
            // Default là sản phẩm mới
            $products = Product::whereNull('deleted_at')->where('status', 1)
                ->orderBy('id', 'desc')
                ->get();
            $title = 'Tất cả sản phẩm mới';
        }

        // Thêm dòng này để lấy danh mục
        $categories = Category::whereNull('deleted_at')
        ->where('status', 1)
        ->get();
        
        return view('shop.product.all_products', [
            'products' => $products,
            'categories' => $categories,
            'title' => $title
        ]);
    }



    public function detail($slug)
    {
        $products = Product::where('slug', $slug)
            ->whereNull('deleted_at')
            ->where('status', 1)
            ->first();

        if (!$products) {
            abort(404);
        }

        // Tăng lượt xem
        $products->increment('views');

        // Lấy sản phẩm liên quan: cùng danh mục, khác id hiện tại, status=1
        $relatedProducts = Product::where('cat_id', $products->cat_id)
            ->where('id', '!=', $products->id)
            ->where('status', 1)
            ->whereNull('deleted_at')
            ->limit(6)
            ->get();

        return view('shop.product.detail', compact('products', 'relatedProducts'));
    }


    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $cart = session()->get('cart', []);

        // Nếu sản phẩm đã có thì cộng dồn số lượng
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
            // Nếu chưa có thì thêm mới
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image, // cần có trường image trong bảng
                'quantity' => $request->quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    public function ProductByCategory($slug)
    {
        // Lấy danh mục theo slug
        $category = Category::where('slug', $slug)->first();

        // Kiểm tra xem danh mục có tồn tại không
        if (!$category) {
            abort(404); // Nếu không tìm thấy, trả về lỗi 404
        }

        // Lấy tất cả sản phẩm của danh mục này
        $products = $category->products;

        return view('shop.product.category', compact('category', 'products'));
    }


    // 
    public function search(Request $request)
    {
        $keyword = $request->input('product');
        $products = Product::where('status', 1)
            ->whereNull('deleted_at')
            ->where('product_name', 'like', '%' . $keyword . '%')
            ->orderBy('id','desc')
            ->get();
        return view('shop.product.search', compact('products', 'keyword'));
    }

    // Hiển thị sản phẩm liên quan (cùng danh mục với sản phẩm đang xem chi tiết) 
    public function getAvailableProducts()
    {
        // Lấy các sản phẩm mà người dùng chưa đặt
        $userId = Auth::id(); // Lấy ID người dùng đang đăng nhập
        
        // Lấy tất cả các ID sản phẩm đã được người dùng đặt trong đơn hàng
        $orderedProductIds = OrderDetail::join('orders', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.user_id', $userId) // Chỉ lấy đơn hàng của người dùng hiện tại
            ->pluck('order_details.product_id'); // Lấy danh sách ID sản phẩm trong đơn hàng
        
        // Lấy danh sách các sản phẩm chưa được đặt
        $availableProducts = Product::whereNotIn('id', $orderedProductIds)->get();

        // Trả về dữ liệu ra view
        return view('shop.user.account', compact('availableProducts'));
    }
}