<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class CategoryController extends Controller
{
    // 1. Hiển thị danh sách danh mục (cả chưa xóa)
    public function index()
    {
        $users = auth()->user();

        $categories = Category::whereNull('deleted_at')->orderBy('id','desc')->paginate(5);
        $trashCount = Category::onlyTrashed()->count();
        return view('admin.category.list', compact('categories', 'trashCount', 'users'));
    }

    // 2. Hiển thị form thêm mới danh mục
    public function create()
    {
        // Lấy tất cả danh mục hiện có (loại bỏ các bản ghi soft-deleted)
        $categories = Category::whereNull('deleted_at')->get();

        // Trả về view và truyền biến $categories
        return view('admin.category.create', compact('categories'));
    }


    // 3. Lưu danh mục mới
    public function store(Request $request)
    {
        // 1. Validate đầu vào
        $data = $request->validate([
            'category_name' => 'required|string|max:1000',
            'slug'          => 'nullable|string|max:1000|unique:categories,slug',
            'parent_id'     => 'required|integer',
            'sort_order'    => 'nullable|integer',
            'description'   => 'nullable|string',
            'status'        => 'required|in:0,1',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // 2. Sinh slug tự động nếu người dùng để trống
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['category_name']);
        }

        // 3. Xử lý upload ảnh (nếu có)
        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/categories'), $filename);
            $data['image'] = $filename;
        }

        // 4. Các trường mặc định
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['created_by'] = Auth::id();
        $data['updated_by'] = Auth::id();

        // 5. Tạo mới bản ghi
        Category::create($data);

        // 6. Redirect về danh sách với flash message
        return redirect()
            ->route('admin.categoryList')
            ->with('success', 'Đã thêm danh mục mới thành công!');
    }
    
    // 4. Hiển thị form sửa danh mục
    public function edit($id)
    {
        // Lấy danh mục cần chỉnh sửa
        $category = Category::findOrFail($id);

        // Lấy tất cả các danh mục cha để hiển thị trong dropdown
        $categories = Category::whereNull('deleted_at')->get();

        // Trả về view chỉnh sửa danh mục
        return view('admin.category.edit', compact('category', 'categories'));
    }

    // 5. Cập nhật danh mục
    public function update(Request $request, $id)
    {
        // 1) Validate đầu vào, cho phép parent_id = 0
        $request->validate([
            'category_name' => 'required|string|max:255',
            'slug'          => 'nullable|string|max:255',
            'parent_id'     => ['required', 'integer', 'min:0'], // cho phép 0 trở lên
            'status'        => 'required|boolean',
            'description'   => 'nullable|string',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // 2) Lấy danh mục cần cập nhật
        $category = Category::findOrFail($id);
    
        // 3) Cập nhật các trường cơ bản
        $category->category_name = $request->category_name;
        $category->slug = $request->slug ?: Str::slug($request->category_name);
        $category->status = $request->status;
        $category->description = $request->description;
    
        // 4) Xử lý parent_id: nếu >0 thì bắt buộc phải tồn tại
        $parentId = (int)$request->parent_id;
        if ($parentId > 0) {
            // Kiểm tra tồn tại
            if (! Category::where('id', $parentId)->exists()) {
                return back()
                    ->withErrors(['parent_id' => 'Danh mục cha không tồn tại.'])
                    ->withInput();
            }
            $category->parent_id = $parentId;
        } else {
            // Chọn "Không có"
            $category->parent_id = 0;
        }
    
        // 5) Xử lý ảnh mới
        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path('images/categories/' . $category->image))) {
                unlink(public_path('images/categories/' . $category->image));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/categories/'), $filename);
            $category->image = $filename;
        }
    
        // 6) Lưu và redirect
        $category->save();
    
        return redirect()->route('admin.categoryList')
            ->with('success', 'Cập nhật danh mục thành công!');
    }


    // 6. Xóa mềm danh mục
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete(); // Soft delete nếu model dùng SoftDeletes trait

        return redirect()->route('admin.categoryList')->with('success', 'Đã xóa danh mục (mềm).');
    }

    // 7. Khôi phục danh mục đã xóa
    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('admin.categoryList')->with('success', 'Đã khôi phục danh mục.');
    }

    // 8. Danh sách các danh mục đã bị xóa (soft deleted)
    public function trash()
    {
        $categories = Category::onlyTrashed()->orderBy('id','desc')->paginate(5);
        return view('admin.category.trash', compact('categories'));
    }

    // 9. Xóa vĩnh viễn danh mục
    public function forceDelete($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->forceDelete();

        return redirect()->route('admin.categoryTrashList')->with('success', 'Đã xóa vĩnh viễn danh mục.');
    }

    // 10. Hiển thị chi tiết danh mục
    public function show($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        return view('admin.category.show', compact('category'));
    }
}
