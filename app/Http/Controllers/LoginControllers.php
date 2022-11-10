<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginControllers extends Controller
{
    public function loginView()
    {
        return view('dang_nhap');
    }

    public function doLogin(Request $request)
    {   
        $login = User::where('email', $request->email)->first();
        session()->flashInput($request->input());
        if (!isset($login)) {
            return redirect('dang-nhap')->with('error', 'Tài khoản không tồn tại!');
        } else if (!Hash::check($request->password,$login->password)){
            return redirect('dang-nhap')->with('error', 'Sai mật khẩu!');
        }
        Auth::login($login);
        session()->put('login', true);
        session()->put('name', $login->name);
        return redirect()->route('dashboards');
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login')->with('success', 'Đăng xuất thành công!');;
    }

}
