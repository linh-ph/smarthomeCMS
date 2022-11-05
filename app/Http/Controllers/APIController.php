<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class APIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (!$token = JWTAuth::attempt(['email' => $email, 'password' => $password])) {
            return response()->json([
                'status' => false,
                'messager' => "Đăng nhập thất bại",
            ]);
        }
        $data = User::where('email', $request->email)->first();
        $data->remember_token = $token;
        $data->save();

        return response()->json([
            'status' => true,
            'messager' => "Đăng nhập thành công",
            'data' => $data
        ]);
    }

    public function logout(Request $request)
    {
        try {
            $customer = User::find(JWTAuth::user()->id);
            if ($customer->fcm_token == $request->fcm_token) {
                $customer->fcm_token = '';
                $customer->save();
            }
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json([
                'status' => true,
                'message' => 'Đăng xuất thành công',
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Đăng xuất thất bại',
            ]);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
        }
    }

    public function thayDoiMatKhau(Request $request)
    {
        $user = User::where('email', JWTAuth::user()->email)->first();
        if (!isset($user)) {
            return response()->json([
                'status' => false,
                'messager' => "Token đã hết hạn, vui lòng đăng nhập lại!",
            ]);
        }
        if ($request->password != $request->re_password) {
            return response()->json([
                'status' => false,
                'messager' => "Nhập lại mật khẩu không giống nhau. Vui lòng thử lại!",
            ]);
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json([
            'status' => true,
            'messager' => "Đã cập nhật thành công mật khẩu mới!"
        ]);
    }

    public function capNhat(Request $request)
    {
        $user = User::where('email', JWTAuth::user()->email)->first();
        if (!isset($user)) {
            return response()->json([
                'status' => false,
                'messager' => "Token đã hết hạn, vui lòng đăng nhập lại!",
            ]);
        }
        if (!isset($request->name) || !isset($request->email)) {
            return response()->json([
                'status' => false,
                'messager' => "Vui lòng nhập đầy đủ thông tin",
            ]);
        } else {
            $user->email = $request->email;
            $user->name = $request->name;
            $user->save();
            if (!$token = JWTAuth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return response()->json([
                    'status' => false,
                    'messager' => "Cập nhật thất bại",
                ]);
            } else {
                $user->remember_token = $token;
                $user->save();
                return response()->json([
                    'status' => true,
                    'messager' => "Cập nhật thành công",
                    'data' => $user
                ]);
            }
        }
    }

    public function getUserInfo(Request $request)
    {
        $user = JWTAuth::user();
        return response()->json($user);
    }
}
