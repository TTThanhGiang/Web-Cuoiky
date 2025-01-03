<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Hiển thị danh sách người dùng
    public function index()
    {
        $users = User::all();
        $childView = 'management-user'; // hoặc lấy giá trị này từ đâu đó, ví dụ: session hoặc query string
        $view = 'users';
        return view('admin.user.index', compact('childView','view','users'));

    }

    // Hiển thị form tạo người dùng mới
    public function create()
    {
        $childView = 'create-admin'; // hoặc lấy giá trị này từ đâu đó, ví dụ: session hoặc query string
        $view = 'users';
        return view('admin.user.create', compact('childView', 'view'));
    }
    
    public function store(Request $request)
    {
        // Validate dữ liệu
        $params = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'status' => 'required|boolean',
            'password' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id',
        ]);

        $result = User::create($params);

        return redirect()->route('admin.User.index')->with('success', 'User created successfully');
    }

    // Hiển thị chi tiết người dùng
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    // Hiển thị form chỉnh sửa người dùng
    public function edit($id)
    {
        $user = User::find($id);  // Tìm người dùng theo id
        if (!$user) {
            abort(404, 'User not found');
        }
        $childView = 'management-user'; // hoặc lấy giá trị này từ đâu đó, ví dụ: session hoặc query string
        $view = 'users';
        // Trả về view chỉnh sửa với dữ liệu người dùng
        return view('admin.user.edit', compact('user','childView','view'));
    }

    // Cập nhật người dùng
    public function update(Request $request, $id)
    {
        $user = User::find($id);  // Tìm người dùng theo id

        // Xác thực dữ liệu (nếu cần)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'status' => 'required|boolean',
        ]);

        // Cập nhật dữ liệu người dùng
        $user->name = $request->input('name');
        $user->address = $request->input('address');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->status = $request->input('status');
        $user->role_id = $request->input('role_id');  // Giả sử bạn cũng có cột role_id
        $user->save();  // Lưu thay đổi vào cơ sở dữ liệu

        return redirect()->route('admin.User.edit', ['id' => $id])->with('success', 'User updated successfully');
    }

    public function delete($id)
        {
            $user = User::findOrFail($id);
            $user->update(['status'=> 0]);
            return redirect()->route('admin.User.index')->with('success', 'User deleted successfully');
        }
        public function search(Request $request)
    {
        $search = $request->input('searchusers');
        $view = 'users';
        $childView = 'management-user';
        $users = User::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->get();

        return view('admin.User.index', compact('users','view','childView'));
    }
}
