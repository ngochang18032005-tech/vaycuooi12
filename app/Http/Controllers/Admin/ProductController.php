<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    
    public function index()
    {
        $users = auth()->user();

        $products = Product::whereNull('deleted_at')->whereNotNull('cat_id')->orderBy('id', 'desc')->paginate(5);
        $trashCount = Product::onlyTrashed()->count();
        return view('admin.product.list', compact('products', 'trashCount', 'users'));
    }


    public function create()
    {
        $allCategories = Category::whereNull('deleted_at')->get();

        $categories = $allCategories->filter(function ($category) use ($allCategories) {
            return !$allCategories->contains('parent_id', $category->id);
        }); // Lấy toàn bộ danh mục từ database
        $brands = Brand::whereNull('deleted_at')->get(); // Nếu có bảng brands, lấy toàn bộ dữ liệu
        return view('admin.product.create', compact('categories', 'brands'));
    }
   

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'productName' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'cat' => 'required|exists:categories,id',
            'brand' => 'nullable|exists:brands,id',
            'qty' => 'required|integer|min:0',
            'price' => 'required|integer|min:1000',
            'sale_price' => 'nullable|integer|min:0', // Sale price có thể bỏ qua
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images/products');
            $file->move($destinationPath, $imageName);
            $imagePath = $imageName;
        }

        // Create new product
        $product = new Product();
        $product->product_name = $request->input('productName');
        $product->slug = $request->input('slug') ?: Str::slug($request->input('productName'));
        $product->cat_id = $request->input('cat');
        $product->brand_id = $request->input('brand');
        $product->qty = $request->input('qty');
        $product->price = $request->input('price');
        // Nếu không có sale_price, gán giá trị mặc định là 0
        $product->sale_price = $request->filled('sale_price') ? $request->input('sale_price') : 0;
        $product->image = $imagePath;
        $product->status = $request->input('status');
        $product->created_by = auth()->user()->id; // Assuming you have an auth system
        $product->save();

        // Redirect with success message
        return redirect()->route('admin.productList')->with('success', 'Sản phẩm đã được thêm thành công');
    }


        
    
    public function show($id)
    {
        $product = Product::with('category', 'brand')->findOrFail($id);

        return view('admin.product.detail', compact('product'));
    }

    public function edit(string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $allCategories = Category::whereNull('deleted_at')->get();

        $categories = $allCategories->filter(function ($category) use ($allCategories) {
            return !$allCategories->contains('parent_id', $category->id);
        });
    
        $brands = Brand::whereNull('deleted_at')->where('status', 1)->get();
        return view('admin.product.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, string $slug)
    {
         // Tìm sản phẩm cần cập nhật
         $product = Product::where('slug', $slug)->firstOrFail();

         // Xử lý ảnh nếu có file mới được tải lên
        if ($request->hasFile('image')) {
             // Xóa ảnh cũ nếu tồn tại
            if ($product->image && file_exists(public_path('images/products/' . $product->image))) {
                unlink(public_path('images/products/' . $product->image));
            }
 
             // Upload ảnh mới
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/products/'), $imageName);
            $product->image = $imageName;
        }
 
         // Cập nhật thông tin sản phẩm
        $product->update([
            'product_name' => $request->productName,
            'slug'         => $request->slug,
            'cat_id'       => $request->cat,
            'description'  => $request->description,
            'price'        => $request->price,
            'is_on_sale'   => $request->is_on_sale,
            'sale_price'   => $request->sale_price,
            'qty'          => $request->qty,
            'brand_id'     => $request->brand,
            'status'       => $request->status,
        ]);
 
        return redirect()->route('admin.productList')
            ->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }

    
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'Đã chuyển sản phẩm vào thùng rác!');
    }

    public function trashList()
    {
        $products = Product::onlyTrashed()->orderBy('id', 'desc')->paginate(5);
        return view('admin.product.trash', compact('products'));
    }

    // xóa vĩnh viễn sản phẩm trong trash 
    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);

        if ($product->image && file_exists(public_path('images/products/' . $product->image))) {
            unlink(public_path('images/products/' . $product->image));
        }

        $product->forceDelete();

        return redirect()->route('admin.productTrashList')->with('success', 'Đã xoá vĩnh viễn sản phẩm!');
    }

    // khôi phục sản phẩm
    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->back()->with('success', 'Đã khôi phục sản phẩm thành công!');
    }
}