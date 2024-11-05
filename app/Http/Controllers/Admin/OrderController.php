<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders; 
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Lấy tất cả đơn hàng để hiển thị cho admin
        $orders = Orders::all();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Cập nhật trạng thái đơn hàng
        $order = Orders::findOrFail($id);
        $order->status = $request->status; // status có thể là 'paid' hoặc 'cancelled'
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }

    public function destroy(Orders $order)
    {
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã được xóa thành công.');
    }
    
    public function show($id)
    {
        // Tìm đơn hàng theo ID và load các mục hàng với mối quan hệ orderItems
        $order = Orders::with('orderItems.product')->find($id); 
    
        // Kiểm tra xem đơn hàng có tồn tại hay không
        if (!$order) {
            return redirect()->route('admin.orders.index')->with('error', 'Đơn hàng không tồn tại.');
        }
    
        return view('admin.orders.show', compact('order')); 
    }    
}
