<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Chatify\Facades\Chatify;
use App\Models\User;

class ChatController extends Controller
{
    // Phương thức hiển thị cuộc trò chuyện với admin (ID = 1)
    public function showChat($id = 1)
    {
        // Kiểm tra xem người dùng có tồn tại không
        $user = User::findOrFail($id);

        // Nếu người dùng không phải admin, chuyển hướng đến trang chủ
        if ($id != 1) {
            return redirect()->route('chatify.chat', ['id' => 1]);
        }

        // Trả về view chat với dữ liệu user (admin)
        return view('chatify::home', compact('user'));
    }

    // Phương thức gửi tin nhắn
    public function sendMessage(Request $request, $id)
    {
        // Kiểm tra nếu có tin nhắn được gửi
        if ($request->has('message')) {
            // Gửi tin nhắn bằng cách sử dụng Chatify
        //    Chatify::sendMessage([
         //       'user_id' => auth()->id(), // Người gửi là người dùng đã đăng nhập
         //       'message' => $request->message, // Nội dung tin nhắn
          //      'to_user_id' => $id, // Gửi đến user có id = $id
          //  ]);
        }

        // Chuyển hướng lại trang chat sau khi gửi tin nhắn
        return redirect()->route('chatify.chat', ['id' => $id]);
    }
}
