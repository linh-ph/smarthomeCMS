<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class QuanTriVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quanTriVien = Admin::all();
        return view('QuanTriVien.ds_quan_tri_vien',compact('quanTriVien'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            $thongBao = 0;
            return view('QuanTriVien.them-moi-nguoi-dung', compact('thongBao'));
        } else {
            return redirect('dang-nhap');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:admin|max:255',
            'password' => 'required',
            'name' => 'required',
            'phone' => 'required|unique:admin|max:11',
        ]);
        if ($validator->fails()) {
            return redirect('quan-tri-vien')->with('error', 'Thêm thất bại!'); 
        }
        else
        {
            $quanTriVien = new Admin();
            $quanTriVien->name = $request->name;
            $quanTriVien->phone = $request->phone;
            $quanTriVien->password = Hash::make($request->password);
            $quanTriVien->username = $request->username;
            $quanTriVien->save();
            return redirect('quan-tri-vien')->with('success', 'Thêm thành công!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quanTriVien = Admin::find($id);
        $quanTriVien->delete();
        return redirect('quan-tri-vien')->with('success', 'Xóa thành công!');
    }

    public function bin()
    {
        $quanTriVien = Admin::onlyTrashed()->get();
        return view('QuanTriVien.thung-rac',compact('quanTriVien'));
    }

    public function restore($id)
    {
        $quanTriVien = Admin::withTrashed()->find($id);
        $quanTriVien->restore();
        $quanTriVien = Admin::all();
        return redirect('quan-tri-vien')->with('success', 'Phục hồi thành công!');
    }

    public function delete($id)
    {
        $quanTriVien = Admin::withTrashed()->find($id);
        $quanTriVien->forceDelete();
        $quanTriVien = Admin::all();
        return redirect('quan-tri-vien/thung-rac')->with('success', 'Xóa quản trị viên ra khỏi thùng rác thành công!');
    }

    public function login()
    {
        return view('dang_nhap');
    }
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login')->with('success', 'Đăng xuất thành công!');;
    }

    public function xuly(Request $request)
    {
        $qtv = Admin::where('username',$request->username )->first();
        session()->flashInput($request->input());
        if (!isset($qtv)) {
            return redirect('dang-nhap')->with('error', 'Tài khoản không tồn tại!');
        } else if (!Hash::check($request->password,$qtv->password)){
            return redirect('dang-nhap')->with('error', 'Sai mật khẩu!');
        }
        Auth::login($qtv);
        session()->put('login', true);
        session()->put('name', $qtv->name);
        return redirect('nguoi-dung');
    }
}