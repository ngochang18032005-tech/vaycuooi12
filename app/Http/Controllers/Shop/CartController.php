<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $cart = session()->get('cart', []);

        // Tính tổng tiền
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        return view('shop.user.cart', compact('cart', 'totalPrice', 'user'));
    }

    // Đếm số lượng dòng trong giỏ giỏ hàng 
    public function getCartItemCount()
    {
        $cart = session('cart', []);
    
        $cartItemCount = count($cart);
    
        return response()->json([
            'count' => $cartItemCount
        ]);
    }
    

    // Thêm sản phẩm vào giỏ hàng
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1); // Mặc định là 1 nếu không có

        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'name' => $product->product_name,
                'price' => $product->sale_price > 0 ? $product->sale_price : $product->price, // Lấy giá sale nếu có
                'image' => $product->image,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }



    // xóa sản phẩm trong giỏ hàng
    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);

            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    // Xóa toàn bộ sản phẩm trong giỏ hàng
    public function clearCart()
    {
        session()->forget('cart'); // Xóa giỏ hàng khỏi session

        return redirect()->back()->with('success', 'Đã xóa toàn bộ sản phẩm trong giỏ hàng!');
    }

    // tóm tắt giỏ hàng
    public function showCart()
    {
        $cart = session()->get('cart', []);

        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Truyền $cart và $totalPrice xuống view
        return view('shop.user.cart', compact('cart', 'totalPrice'));
    }



    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $productId = $request->input('product_id');
        $action = $request->input('action');

        if (isset($cart[$productId])) {
            if ($action == 'increase') {
                $cart[$productId]['quantity'] += 1;
            } elseif ($action == 'decrease' && $cart[$productId]['quantity'] > 1) {
                $cart[$productId]['quantity'] -= 1;
            }
        }

        // Cập nhật lại giỏ hàng trong session
        session()->put('cart', $cart);

        // Tính lại tổng tiền giỏ hàng
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Trả về tổng tiền giỏ hàng
        return response()->json([
            'totalPrice' => $totalPrice
        ]);
    }


    // Xử lý thanh toán
    public function checkout(Request $request)
    {
        // 1. Kiểm tra đăng nhập
        if (!Auth::check()) {
            return redirect()->route('shop.cart')
                            ->with('error', 'Vui lòng đăng nhập để đặt hàng.');
        }
        $user = Auth::user();

        // 2. Validate dữ liệu người dùng
        $request->validate([
            'name'    => 'required|string|max:1000',
            'email'   => 'required|email|max:1000',
            'phone'   => 'required|string|max:1000',
            'address' => 'required|string|max:1000',
        ]);

        // 3. Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.cart')
                            ->with('error', 'Giỏ hàng trống.');
        }

        // 4. Bắt đầu transaction
        DB::beginTransaction();
        try {
            // 5. Tạo Order (xóa dòng 'username')
            $order = Order::create([
                'user_id'    => $user->id,
                'name'       => $request->input('name'),
                'email'      => $request->input('email'),
                'phone'      => $request->input('phone'),
                'address'    => $request->input('address'),
                'created_by' => $user->id,
                'status'     => 1,
            ]);

            // 6. Tạo OrderDetail cho từng sản phẩm
            foreach ($cart as $productId => $item) {
                $qty      = $item['quantity'];
                $price    = $item['price'];
                $discount = $item['discount'] ?? 0;
                $amount   = ($price * $qty) - $discount;

                OrderDetail::create([
                    'order_id'   => $order->id,
                    'product_id' => $productId,
                    'qty'        => $qty,
                    'price'      => $price,
                    'discount'   => $discount,
                    'amount'     => $amount,
                ]);
            }

            // 7. Commit & xóa giỏ hàng
            DB::commit();
            session()->forget('cart');

            // 8. Redirect về page giỏ hàng với thông báo thành công
            return redirect()->route('shop.cart')
                            ->with('success', 'Đặt hàng thành công! Chúng tôi sẽ liên hệ sớm.');
        }
        catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout Error: '.$e->getMessage());
            return redirect()->route('shop.cart')
                            ->with('error', 'Có lỗi xảy ra khi đặt hàng. Vui lòng thử lại.');
        }
    }

}