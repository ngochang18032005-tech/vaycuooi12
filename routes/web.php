<?php

use Illuminate\Support\Facades\Route;

//shop
use App\Http\Controllers\Shop\HomeController;
use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\Shop\UserController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\ContactController;
use App\Http\Controllers\Shop\OrderController;



//admin
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\CustomUserController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\OrderDetailController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

//TRANG NGƯỜI DÙNG (SHOP)
Route::get('/', [HomeController::class, 'index']) ->name('shop.home');
// tất cả sản phẩm
Route::get('/tat-ca-san-pham', [ProductController::class, 'index']) ->name('shop.product');
Route::get('/tat-ca-san-pham/{type?}', [ProductController::class, 'products'])->name('shop.allProduct');
//sản phẩm theo danh mục 
Route::get('/danh-muc/{slug}', [ProductController::class, 'ProductByCategory']) ->name('shop.category');
//chi tiết sản phẩm
Route::get('/chi-tiet-san-pham/{slug}', [ProductController::class, 'Detail']) ->name('shop.detail');
// đăng nhập, đăng ký, đăng xuất
Route::get('/dang-ky', [UserController::class, 'Registration']) ->name('shop.registration');
Route::post('/dang-ky', [UserController::class, 'doRegistration'])->name('shop.doRegistration');
Route::get('/dang-nhap', [UserController::class, 'Login']) ->name('shop.login');
Route::post('/dang-nhap', [UserController::class, 'doLogin']) ->name('shop.doLogin');
Route::get('/dang-xuat', [UserController::class, 'Logout']) ->name('shop.logout');
// profile người dùng 
Route::get('/tai-khoan', [UserController::class, 'account'])->name('shop.account')->middleware('auth');
// chỉnh sửa user
Route::get('/chinh-sua-nguoi-dung', [UserController::class, 'edit'])->name('user.edit');
// Xử lý cập nhật user
Route::post('/cap-nhat-nguoi-dung', [UserController::class, 'update'])->name('user.update');
// giỏ hàng
Route::get('/gio-hang', [CartController::class, 'index']) ->name('shop.cart');
Route::post('/them-gio-hang', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/xoa-gio-hang', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/gio-hang/clear', [CartController::class, 'clearCart'])->name('shop.cart.clear');
Route::get('/chi-tiet-gio-hang', [CartController::class, 'showCart'])->name('cart.show');
//
Route::post('/cap-nhat-gio-hang', [CartController::class, 'updateCart'])->name('cart.update');
// thanh toán 
Route::post('/checkout', [CartController::class, 'checkout'])->name('shop.cart.checkout');
// tìm kiếm sản phẩm
Route::get('/tim-kiem', [ProductController::class, 'search'])->name('product.search');
// liên hệ 
Route::get('/lien-he', [ContactController::class, 'index'])->name('contact.index');
// Lọc sản phẩm theo thương hiệu 
Route::get('/san-pham-cua-thuong-hieu', [ProductController::class, 'productsToBrand'])->name('shop.productsToBrand');
// Lịch sử Đơn đặt hàng
Route::middleware('auth')->group(function () {
    Route::get('/lich-su-don-hang', [OrderController::class, 'history'])->name('orders.history');
});
Route::middleware('auth')->get('/chi-tiet-don-hang/{order}', [OrderController::class, 'show'])->name('orders.show');






// Authentication
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::get('admin/dang-nhap', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/dang-nhap', [AdminAuthController::class, 'login'])->name('admin.doLogin');
Route::get('admin/dang-xuat', [AdminAuthController::class, 'logout'])->name('admin.logout');

// TRANG QUẢN LÝ (ADMIN)
Route::prefix('admin')->middleware(['auth'])->group(function (){

    //CATEGORY - danh muc 
    Route::get('/', [AdminHomeController::class, 'index']) ->name('admin.home');
    Route::get('/danh-muc', [CategoryController::class, 'index']) ->name('admin.categoryList');
    // Thêm danh mục 
    Route::get('/them-danh-muc', [CategoryController::class, 'create']) ->name('admin.categoryCreate');
    Route::post('/them-danh-muc', [CategoryController::class, 'store']) ->name('admin.categoryStore');
    // Sửa danh mục
    Route::get('/sua-danh-muc/{id}', [CategoryController::class, 'edit']) ->name('admin.categoryEdit');
    Route::post('/sua-danh-muc/{id}', [CategoryController::class, 'update']) ->name('admin.categoryUpdate');
    // Khôi phục danh mục 
    Route::get('/khoi-phuc-danh-muc/{id}', [CategoryController::class, 'restore']) ->name('admin.categoryRestore');
    // Xóa mềm danh mục
    Route::delete('/xoa-danh-muc/{id}', [CategoryController::class, 'destroy']) ->name('admin.categoryDelete');
    // Hiển thị danh mục đã xóa
    Route::get('/danh-sach-danh-muc-da-xoa', [CategoryController::class, 'trash']) ->name('admin.categoryTrashList');
    // Xoá vĩnh viễn danh mục (force delete)
    Route::delete('/xoa-vinh-vien-danh-muc/{id}', [CategoryController::class, 'forceDelete'])->name('admin.categoryForceDelete');
    // Show danh mục (detail)
    Route::get('/chi-tiet-danh-muc/{id}', [CategoryController::class, 'show'])->name('admin.categoryShow');



    //PRODUCT - san pham 
    Route::get('/san-pham', [AdminProductController::class, 'index']) ->name('admin.productList');
    // Thêm sản phẩm
    Route::get('/them-san-pham', [AdminProductController::class, 'create']) ->name('admin.productCreate');
    Route::post('/them-san-pham', [AdminProductController::class, 'store']) ->name('admin.productStore');
    // sửa sản phẩm
    Route::get('/sua-san-pham/{slug}', [AdminProductController::class, 'edit']) ->name('admin.productEdit');
    Route::post('/sua-san-pham/{slug}', [AdminProductController::class, 'update']) ->name('admin.productUpdate');
    // danh sách xóa tạm (trash) 
    Route::post('/xoa-tam-san-pham/{id}', [AdminProductController::class, 'trash']) ->name('admin.productTrash');
    Route::get('/danh-sach-san-pham-da-xoa', [AdminProductController::class, 'trashList']) ->name('admin.productTrashList');
    // khôi phục sản phẩm khi ở trong trash
    Route::get('/khoi-phuc-san-pham/{id}', [AdminProductController::class, 'restore']) ->name('admin.productRestore');
    Route::delete('/xoa-san-pham/{id}', [AdminProductController::class, 'destroy']) ->name('admin.productDelete');
    // Xoá vĩnh sản phẩm trong trash (force delete)
    Route::delete('/xoa-vinh-vien-san-pham/{id}', [AdminProductController::class, 'forceDelete'])->name('admin.productForceDelete');
    // Show sản phẩm (detail)
    Route::get('/chi-tiet-san-pham/{id}', [AdminProductController::class, 'show'])->name('admin.productShow');



    // BRAND - thương hiệu
    Route::get('/thuong-hieu', [BrandController::class, 'index'])->name('admin.brandList');
    Route::get('/them-thuong-hieu', [BrandController::class, 'create'])->name('admin.brandCreate');
    Route::post('/them-thuong-hieu', [BrandController::class, 'store'])->name('admin.brandStore');
    Route::get('/sua-thuong-hieu/{id}', [BrandController::class, 'edit'])->name('admin.brandEdit');
    Route::post('/sua-thuong-hieu/{id}', [BrandController::class, 'update'])->name('admin.brandUpdate');
    Route::delete('/xoa-thuong-hieu/{id}', [BrandController::class, 'destroy'])->name('admin.brandDestroy');
    Route::get('/thung-rac-thuong-hieu', [BrandController::class, 'trash'])->name('admin.brandTrash');
    Route::get('/khoi-phuc-thuong-hieu/{id}', [BrandController::class, 'restore'])->name('admin.brandRestore');
    Route::get('/chi-tiet-thuong-hieu/{id}', [BrandController::class, 'show'])->name('admin.brandShow');
    Route::delete('/xoa-vinh-vien-thuong-hieu/{id}', [BrandController::class, 'forceDelete'])->name('admin.brandForceDelete');


    // USERS - Người dùng
    Route::get('/nguoi-dung', [CustomUserController::class, 'index'])->name('admin.userList');
    Route::get('/them-nguoi-dung', [CustomUserController::class, 'create'])->name('admin.userCreate');
    Route::post('/them-nguoi-dung', [CustomUserController::class, 'store'])->name('admin.userStore');
    Route::get('/sua-nguoi-dung/{id}', [CustomUserController::class, 'edit'])->name('admin.userEdit');
    Route::post('/sua-nguoi-dung/{id}', [CustomUserController::class, 'update'])->name('admin.userUpdate');
    Route::get('/chi-tiet-nguoi-dung/{id}', [CustomUserController::class, 'show'])->name('admin.userShow');
    Route::delete('/xoa-vinh-vien-nguoi-dung/{id}', [CustomUserController::class, 'forceDelete'])->name('admin.userForceDelete');



    // ORDER - Đơn hàng
    Route::get('/don-hang', [AdminOrderController::class, 'index'])->name('order.index');
    Route::get('chi-tiet-don-hang/{id}', [AdminOrderController::class, 'show'])->name('order.show');
    Route::get('chinh-sua/don-hang/{id}', [AdminOrderController::class, 'edit'])->name('order.edit');
    Route::put('chinh-sua/don-hang/{id}', [AdminOrderController::class, 'update'])->name('order.update');

});