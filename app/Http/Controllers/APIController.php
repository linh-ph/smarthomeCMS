<?php

namespace App\Http\Controllers;

use App\Api\PushNotification;
use App\Devices;
use App\HistoryFeature;
use App\NotificationLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Exception;

class APIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"User"},
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="fcm_token",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="os",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Error server",
     *      )
     * )
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
        $checkDevice = Devices::where([['user_id', $data->id], ['fcm_token', $request->fcm_token]])->first();
        if (!isset($checkDevice)) {
            $checkDevice = Devices::where('user_id', $data->id)->get();
            if (count($checkDevice) > 3) {
                $device = Devices::where('user_id', $data->id)->orderBy('id', 'asc')->first();
                $device->fcm_token = $request->fcm_token;
                if (isset($request->os)) {
                    $device->OS = $request->os;
                }
                $device->save();
                foreach ($checkDevice as $dv) {
                    PushNotification::sendNotification($dv->fcm_token, 'Bạn vừa đăng nhập trên thiết bị mới!', 'Nếu không phải Bạn đang thực hiện đăng nhập, vui lòng mở ứng dụng/trang web và ĐỔI MẬT KHẨU ngay lập tức để bảo vệ tài khoản của bạn!', 'Notification');
                }
            } else {
                $device = new Devices();
                $device->fcm_token = $request->fcm_token;
                $device->user_id = $data->id;
                if (isset($request->os)) {
                    $device->OS = $request->os;
                }
                $device->save();
            }
            $notification = new NotificationLog();
            $notification->title = 'Bạn vừa đăng nhập trên thiết bị mới';
            $notification->message = 'Nếu không phải Bạn đang thực hiện đăng nhập, vui lòng mở ứng dụng/trang web và ĐỔI MẬT KHẨU ngay lập tức để bảo vệ tài khoản của bạn!';
            $notification->user_id = $data->id;
            $notification->save();
        } else {
            $checkDevice->fcm_token = $request->fcm_token;
            $checkDevice->save();
        }

        return response()->json([
            'status' => true,
            'messager' => "Đăng nhập thành công",
            'data' => $data
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     tags={"User"},
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Error server",
     *      )
     * )
     */
    public function logout(Request $request)
    {
        try {
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
        try {
            if (JWTAuth::check()) {
                $userId = JWTAuth::user()->id;
                $editItem = User::where('id', $userId)->first();
                if ($request->isMethod('post')) {
                    $editItem->name = $request->name;
                    $editItem->save();
                    return response()->json(['status' => 'success']);
                }
                $user = User::where('id', $editItem->id)->first();

                return response()->json($user);
            }
            return response()->json('Vui long dang nhap');
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json('Token het han roi');
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json('Token het han');
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json('Sai token');
        } catch (\Tymon\JWTAuth\Exceptions\TokenBlacklistedException $e) {
            return response()->json($e);
        }
    }

    public function getNotification(Request $request)
    {
        $notification = NotificationLog::where('user_id', JWTAuth::user()->id)->paginate(15);

        return response()->json(['status' => true, 'notification' => $notification]);
    }

    public function getHistory(Request $request)
    {
        $history = HistoryFeature::where('user_id', JWTAuth::user()->id)->get();

        return response()->json(['status' => true, 'history' => $history]);
    }
}
