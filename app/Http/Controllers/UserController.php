<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('User.ds_nguoi_dung',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (Auth::check()) {
            $thongBao = 0;
            return view('User.them-moi-nguoi-dung', compact('thongBao'));
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
        $rules = [
            'email' => 'required|unique:user',
            'name' => 'required',
            'password' => 'required',
            'repassword' => 'required|same:password'
        ];
        $customMessages = [
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email đã tồn tại',
            'name.required' => 'Họ và tên không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            $error = '';
            foreach($validator->errors()->messages() as $item) {
                $error = $error . ' ' . $item[0] . '. ';
            }
            session()->flashInput($request->input());
            return redirect()->back()->with('error', 'Thêm thất bại, '. $error);
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect('nguoi-dung')->with('success', 'Thêm thành công!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bin()
    {
        $users = User::onlyTrashed()->get();
        return view('User.thung-rac',compact('users'));
    }

    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();
        $user = User::all();
        return redirect('nguoi-dung')->with('success', 'Phục hồi thành công!');
    }

    public function delete($id)
    {
        $user = User::withTrashed()->find($id);
        $user->forceDelete();
        $user = User::all();
        return redirect('nguoi-dung/thung-rac')->with('success', 'Xóa người dùng khỏi thùng rác thành công!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if(!isset($user)) {
            return redirect()->back()->with('error', 'Cập nhật thất bại, Không tìm thấy người dùng!');
        }
        return view('User.cap-nhat', compact('user'));
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
        $user = User::find($id);
        if(!isset($user)) {
            return redirect()->back()->with('error', 'Cập nhật thất bại, Không tìm thấy người dùng!');
        }
        $rules = [
            'email' => 'required',
            'name' => 'required',
        ];
        $customMessages = [
            'email.required' => 'Email không được để trống',
            'name.required' => 'Họ và tên không được để trống',
        ];
        $checkEmail = User::where('email', $request->email)->first();
        if(isset($checkEmail) && $checkEmail->id != $user->id) {
            return redirect()->back()->with('error', 'Cập nhật thất bại, email đã tồn tại');
        }
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            $error = '';
            foreach($validator->errors()->messages() as $item) {
                $error = $error . ' ' . $item[0] . '. ';
            }
            session()->flashInput($request->input());
            return redirect()->back()->with('error', 'Cập nhật thất bại, '. $error);
        } else {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            return redirect('nguoi-dung')->with('success', 'Cập nhật thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('nguoi-dung')->with('success', 'Xóa thành công!');
    }

     public function ThongkeSoNguoiDangKi()
    {
        $nguoiChoi = User::whereMonth('created_at',Carbon::now()->month)->count('name');
        //$users = DB::table('nguoi_choi')->count('ten_dang_nhap')->whereMonth('created_at', '2019/12/28')->get();
        return view('ThongKe.thong-ke-dang-ki',compact('nguoiChoi'));
    }
}
