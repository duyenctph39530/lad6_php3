<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function login()
    {
        return view('login');
    }
    public function postLogin(Request $request)
    {
        $data = $request->only(['email', 'password']);
        if (Auth::attempt($data)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('list_user');

            } else {
                return redirect()->back();
            }
            ; //đăng nhập thành công
        } else {
            return redirect()->back()->with('errorLogin', 'Email hoặc Password không chính xác :(');
        }

    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function register()
    {
        return view('register');

    }
    public function postRegister(Request $request)
    {
        $data = $request->validate([
            'fullname' => ['required'],
            'username' => ['required', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:3', 'max:50'],
            'avatar' => ['required'],
        ]);
        $data = $request->except('avatar');
        $data['avatar'] = " ";
        if ($request->hasFile('avatar')) {
            $path_img = $request->file('avatar')->store('images');
            $data['avatar'] = $path_img;
        }
        User::create($data);
        return redirect()->route('login')->with('message', 'Đăng Ký tài khoản thành công!');
    }
    public function show(User $user)
    {
        $user = Auth::user();
        return view('show', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        $user = Auth::user();

        $data = $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|max:2048',
        ]);
        $data = $request->except('avatar');
        $old_avatar = $user->avatar;
        $data['avatar'] = $old_avatar;

        if ($request->hasFile('avatar')) {
            $path_img = $request->file('avatar')->store('images');
            $data['avatar'] = $path_img;
        }

        $user->update($data);
        if (isset($path_img) && file_exists(storage_path('storage/' . $old_avatar))) {
            unlink(storage_path('storage/' . $old_avatar));

        }

        return redirect()->route('show')->with('mes', 'Cập nhật thành cônng');
    }
    public function change_password()
    {
        return view("change_password");
    }
    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:3|string|confirmed',
        ]);
        $user = Auth::user();
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with('mes', 'Mạt khẩu cũ không đúng hãy nhập lại!');
        }
        $user->password = Hash::make($request->new_password);

        $user->save();
        return redirect()->route('change_password')->with('mes', 'Đổi mật khẩu thành công');
    }


}
