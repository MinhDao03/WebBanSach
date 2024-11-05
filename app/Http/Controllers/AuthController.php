<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Hiển thị form đăng ký.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register'); // Đảm bảo view 'auth.register' tồn tại
    }

    /**
     * Xử lý đăng ký người dùng.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Create the user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // Thêm role mặc định là user
            'role' => 'user', // Thêm thuộc tính này nếu bảng users có cột role
        ]);

        // Log in the user
        Auth::attempt($request->only('email', 'password'));

        return redirect()->route('user.dashboard'); // Điều hướng đến trang user sau khi đăng ký
    }

    /**
     * Hiển thị form đăng nhập.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Đảm bảo view 'auth.login' tồn tại
    }

    /**
     * Xử lý đăng nhập người dùng.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to log in
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user(); // Lấy thông tin người dùng đã đăng nhập

            // Kiểm tra vai trò của người dùng và chuyển hướng đến trang tương ứng
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard'); // Trang dành cho admin
            } else {
                return redirect()->route('user.dashboard'); // Trang dành cho user
            }
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không khớp với hồ sơ của chúng tôi.',
        ]);
    }

    /**
     * Xử lý đăng xuất người dùng.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome'); // Đổi 'welcome' thành route bạn muốn sau khi đăng xuất
    }
}
