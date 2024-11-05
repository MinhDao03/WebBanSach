<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\Payment; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Lấy tất cả đơn hàng của người dùng hiện tại
        $orders = Orders::where('user_id', Auth::id())->get();

        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string',
        ]);
    
        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);
    
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn trống.');
        }
    
        // Tính tổng số tiền từ giỏ hàng
        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));
    
        // Tạo đơn hàng mới
        $order = Orders::create([
            'user_id' => Auth::id(),
            'total' => $total, // Tính toán tổng từ giỏ hàng
            'status' => 'processing',
            'payment_method' => $request->payment_method,
            'phone' => $request->phone,           // Lưu số điện thoại
            'address' => $request->address,       // Lưu địa chỉ giao hàng
        ]);
    
        // Lưu các mặt hàng trong đơn hàng
        foreach ($cart as $id => $details) {
            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }
    
        // Tạo bản ghi thanh toán sau khi đơn hàng đã được tạo
        Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total,
            'payment_method' => $order->payment_method,
        ]);
    
        // Xóa giỏ hàng sau khi đặt hàng
        session()->forget('cart');
    
        return redirect()->route('order.index')->with('success', 'Đặt hàng thành công!');
    }
    

    public function show($id)
    {
        // Truy vấn đơn hàng theo ID
        $order = Orders::with('orderItems')->find($id); 

        // Kiểm tra xem đơn hàng có tồn tại hay không
        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Đơn hàng không tồn tại.');
        }

        return view('orders.show', compact('order'));
    }

    

}
