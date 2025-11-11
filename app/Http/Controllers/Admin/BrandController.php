<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;



class BrandController extends Controller
{
    
    public function index()
    {
        $users = auth()->user();
        $brands = Brand::whereNull('deleted_at')->orderBy('id','desc')->paginate(5);
        $trashCount = Brand::onlyTrashed()->count();
        return view('admin.brand.list', compact('brands', 'trashCount', 'users'));
    }


    public function create()
    {
        return view('admin.brand.create');
    }

    // Lưu thương hiệu vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate([
            'name' => 'required|max:1000',
            'slug' => 'required|unique:brands,slug|max:1000',
            'image' => 'nullable|image|max:2048', // Tối đa 2MB
            'description' => 'nullable|max:1000',
            'status' => 'required|in:0,1',
        ]);

        // Tạo đối tượng thương hiệu mới
        $brand = new Brand();
        $brand->name = $request->input('name');
        $brand->slug = $request->input('slug');
        $brand->description = $request->input('description');
        $brand->status = $request->input('status');

        // Xử lý hình ảnh nếu có
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/brands'), $filename);
            $brand->image = $filename;
        }

        // Lưu thương hiệu vào cơ sở dữ liệu
        $brand->save();

        // Quay lại trang danh sách thương hiệu với thông báo thành công
        return redirect()->route('admin.brandList')->with('success', 'Thêm thương hiệu thành công');
    }


    public function restore($id)
    {
        $brand = Brand::withTrashed()->findOrFail($id);
        $brand->restore();

        return redirect()->back()->with('success', 'Khôi phục thương hiệu thành công!');
    }


    public function show(string $id)
    {
        $brand = Brand::with('products')->findOrFail($id);
        return view('admin.brand.detail', compact('brand'));
    }


    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        $brand = Brand::findOrFail($id);

        $brand->name = $request->brand_name;
        $brand->slug = $request->slug;
        $brand->status = $request->status;
        $brand->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/brands'), $imageName);
            $brand->image = $imageName;
        }

        $brand->save();

        return redirect()->route('admin.brandList')->with('success', 'Cập nhật thương hiệu thành công!');
    }

    
    public function forceDelete($id)
    {
        $brand = Brand::withTrashed()->findOrFail($id);
        $brand->forceDelete();

        return redirect()->back()->with('success', 'Đã xoá vĩnh viễn thương hiệu!');
    }


    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return redirect()->back()->with('success', 'Đã xoá thương hiệu vào thùng rác!');
    }

    public function trash()
    {
        $brands = Brand::onlyTrashed()->paginate(5);
        return view('admin.brand.trash', compact('brands'));
    }

}