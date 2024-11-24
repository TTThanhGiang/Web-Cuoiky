<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
class OrderController extends Controller
{
    // Display all orders
    public function index()
    {
        $orders = Order::all(); // You can also paginate this if needed
        $childView = 'management-order'; // Optional: you can set this dynamically
        $view = 'orders'; // Pass view name to the view template
        return view('admin.order.index', compact('orders', 'childView', 'view'));
    }

    // Display the form to create a new order
    public function show($id)
    {
        // Lấy đơn hàng và liên kết với các OrderItems và sản phẩm liên quan
        $order = Order::with('orderItems.product')->findOrFail($id);
        $childView = 'management-order'; // Optional: you can set this dynamically
        $view = 'orders'; // Pass view name to the view template
        return view('admin.order.show', compact('order', 'childView', 'view'));
    }
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $view = 'orders';
        $childView = 'management-order';
        return view('admin.order.edit', compact('order','view','childView'));
    }
    

    public function update(Request $request, $id)
    {
        // Tìm đơn hàng theo ID
        $order = Order::findOrFail($id);
    
        // Xác thực dữ liệu (nếu cần)
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'total_price' => 'required|numeric|min:0', // Tổng giá phải là số và >= 0
            'payment_status' => 'required|in:pending,paid,failed,refunded', // Giá trị hợp lệ
            'delivery_status' => 'required|in:pending,shipped,delivered,cancelled', // Giá trị hợp lệ
        ]);
    
        // Cập nhật dữ liệu đơn hàng
        $order->name = $request->input('name');
        $order->address = $request->input('address');
        $order->phone = $request->input('phone');
        $order->total_price = $request->input('total_price');
        $order->payment_status = $request->input('payment_status');
        $order->delivery_status = $request->input('delivery_status');
        $order->save(); // Lưu thay đổi vào cơ sở dữ liệu
    
        // Chuyển hướng lại trang chỉnh sửa và hiển thị thông báo thành công
        try {
            $order->save();  // Lưu thay đổi vào cơ sở dữ liệu
            return redirect()->route('admin.order.edit', ['id' => $id])
                             ->with('success', 'Order updated successfully');
        } catch (\Exception $e) {
            // Nếu có lỗi khi lưu, trả về thông báo lỗi
            return redirect()->route('admin.order.edit', ['id' => $id])
                             ->withErrors(['error' => 'Failed to update order.']);
        }
    }
    public function search(Request $request)
    {
        $search = $request->input('searchorders');
        $view = 'orders';
        $childView = 'management-order';
        // Lọc đơn hàng theo tên (hoặc các trường khác)
        $orders = Order::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->get();

        // Trả về view với các đơn hàng đã lọc
        return view('admin.order.index', compact('orders','view','childView'));
    }




}
