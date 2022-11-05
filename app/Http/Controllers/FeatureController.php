<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Features;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(Session::has('login') && Session::get('login') == true)
        // {
        $xoa = 0;
        $features = Features::all();
        return view('Feature.ds_tinh_nang', compact('features'));
        // }
        // else
        //     return redirect('dang-nhap');
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
            return view('Feature.them-moi-tinh-nang', compact('thongBao'));
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
            'name' => 'required|unique:feature|max:255',
        ]);
        if ($validator->fails()) {
            return redirect('tinh-nang')->with('error', 'Thêm thất bại!');
        } else {
            $feature = new Features();
            $feature->name = $request->name;
            $feature->status = $request->status;
            $feature->save();
            return redirect('tinh-nang')->with('success', 'Thêm thành công!');
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
        // if(Session::has('login') && Session::get('login') == true)
        // {
        // $cnLinhVuc = LinhVuc::find($id);
        // return view('LinhVuc.cap-nhat-tinh-nang',compact('cnLinhVuc'));
        // }
        // else
        //     return redirect('dang-nhap');
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
        $features = Features::find($id);
        $check = Features::where('name', $request->name)->get()->count();
        if ($features->name != $request->name && $check > 0) {
            return redirect('tinh-nang')->with('error', 'Cập nhật không thành công!');
        } else {
            $features->name = $request->name;
            $features->status = $request->status;
            $features->save();
            return redirect('tinh-nang')->with('success', 'Cập nhật thành công!');
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
        // if(Session::has('login') && Session::get('login') == true)
        // {
        $features = Features::find($id);
        $features->delete();

        $features = Features::all();
        return redirect('tinh-nang')->with('success', 'Xóa thành công!');
        // }
        // else
        //     return redirect('dang-nhap');
    }

    public function bin()
    {
        // if(Session::has('login') && Session::get('login') == true)
        // {
        $features = Features::onlyTrashed()->get();
        return view('Feature.thung-rac', compact('features'));
        // }
        // else
        //     return redirect('dang-nhap');
    }

    public function restore($id)
    {
        $features = Features::withTrashed()->find($id);
        $features->restore();
        $features = Features::all();
        return redirect('tinh-nang')->with('success', 'Phục hồi thành công!');
    }

    public function delete($id)
    {
        $features = Features::withTrashed()->find($id);
        $features->forceDelete();
        $features = Features::all();
        return redirect('tinh-nang/thung-rac')->with('success', 'Xóa lĩnh vực khỏi thùng rác thành công!');
    }
}
