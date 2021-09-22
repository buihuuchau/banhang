<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
// use App\Traits\StorageImageTrait;
use Alert;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\components\myfunction;

class indexController extends Controller
{
    public function loginkhachhang()
    {
        return view('frontend.loginkhachhang');
    }
    public function registerkhachhang()
    {
        return view('frontend.registerkhachhang');
    }
    public function dangxuatkhachhang()
    {
        Session::forget('ssidkhachhang');
        return redirect()->route('index');
    }
    public function editkhachhang($idkhachhang)
    {
        $khachhang = DB::table('khachhang')
            ->where('id', $idkhachhang)
            ->first();
        return view('frontend.editkhachhang', compact('khachhang'));
    }
    public function dologinkhachhang(Request $request)
    {
        $check = DB::table('khachhang')
            ->where('sdtkhachhang', $request->sdtkhachhang)
            ->where('matkhaukhachhang', md5($request->matkhaukhachhang))
            ->first();
        if ($check) {
            $ssidkhachhang = $check->id;
            Session::put('ssidkhachhang', $ssidkhachhang);
            return redirect()->route('index');
        } else {
            return back()->withErrors('Tài khoản hoặc mật khẩu không chính xác');
        }
    }
    public function doregisterkhachhang(Request $request)
    {
        $check = DB::table('khachhang')
            ->where('sdtkhachhang', $request->sdtkhachhang)
            ->first();
        if ($check) {
            return back()->withErrors('Số điện thoại này đã được đăng ký');
        } else {
            $khachhang['sdtkhachhang'] = $request->sdtkhachhang;
            $khachhang['matkhaukhachhang'] = md5($request->matkhaukhachhang);
            $khachhang['hotenkhachhang'] = $request->hotenkhachhang;
            $khachhang['diachikhachhang'] = $request->diachikhachhang;
            $khachhang['diachigiaohang'] = $request->diachikhachhang;
            DB::table('khachhang')->insert($khachhang);
            return redirect('loginkhachhang');
        }
    }
    public function doeditkhachhang(Request $request)
    {
        if ($request->matkhaucukhachhang) {
            $check = DB::table('khachhang')
                ->where('sdtkhachhang', $request->sdtkhachhang)
                ->where('matkhaukhachhang', md5($request->matkhaucukhachhang))
                ->first();
            if ($check == null) {
                return back()->withErrors('Mật khẩu không chính xác');
            } else {
                $khachhang['matkhaukhachhang'] = md5($request->matkhaukhachhang);
                $khachhang['hotenkhachhang'] = $request->hotenkhachhang;
                $khachhang['diachikhachhang'] = $request->diachikhachhang;
                $khachhang['diachigiaohang'] = $request->diachigiaohang;
                DB::table('khachhang')
                    ->where('id', $request->idkhachhang)
                    ->update($khachhang);
                return redirect()->route('index');
            }
        } else {
            $khachhang['hotenkhachhang'] = $request->hotenkhachhang;
            $khachhang['diachikhachhang'] = $request->diachikhachhang;
            $khachhang['diachigiaohang'] = $request->diachigiaohang;
            DB::table('khachhang')
                ->where('id', $request->idkhachhang)
                ->update($khachhang);
            return redirect()->route('index');
        }
    }
    /////////////////////////////////////////////////////////////////////////////////








    /////////////////////////////////////////////////////////////////////////////////
    public function index()
    {
        $thongtinshop = DB::table('thongtinshop')
            ->first();
        $danhmuc = DB::table('danhmuc')
            ->where('hidden', 0)
            ->get();
        $sanpham = DB::table('sanpham')
            ->join('danhmuc', 'sanpham.iddanhmuc', '=', 'danhmuc.id')
            ->orderBy('sanpham.id', 'desc')
            ->where('sanpham.hidden', 0)
            ->where('sanpham.sanphamnoibat', 1)
            ->select('sanpham.*', 'danhmuc.tendanhmuc')
            ->simplePaginate(12);

        $ssidkhachhang = Session::get('ssidkhachhang');
        $khachhang = DB::table('khachhang')
            ->where('id', $ssidkhachhang)
            ->first();
        return view('frontend.index', compact('thongtinshop', 'danhmuc', 'sanpham', 'khachhang'));
    }
    public function sanphamdanhmuc($iddanhmuc)
    {
        $thongtinshop = DB::table('thongtinshop')
            ->first();
        $danhmuc = DB::table('danhmuc')
            ->where('hidden', 0)
            ->get();
        $danhmuc2 = DB::table('danhmuc')
            ->where('id', $iddanhmuc)
            ->first();
        $tendanhmuc = $danhmuc2->tendanhmuc;
        $sanpham = DB::table('sanpham')
            ->where('iddanhmuc', $iddanhmuc)
            ->join('danhmuc', 'sanpham.iddanhmuc', '=', 'danhmuc.id')
            ->orderBy('sanpham.id', 'desc')
            ->where('sanpham.hidden', 0)
            ->select('sanpham.*', 'danhmuc.tendanhmuc')
            ->simplePaginate(12);
        $ssidkhachhang = Session::get('ssidkhachhang');
        $khachhang = DB::table('khachhang')
            ->where('id', $ssidkhachhang)
            ->first();
        return view('frontend.sanphamdanhmuc', compact('thongtinshop', 'danhmuc', 'tendanhmuc', 'sanpham', 'khachhang'));
    }
    public function chitietsanpham($idsanpham)
    {
        $thongtinshop = DB::table('thongtinshop')
            ->first();
        $danhmuc = DB::table('danhmuc')
            ->where('hidden', 0)
            ->get();
        $sanpham = DB::table('sanpham')
            ->where('sanpham.id', $idsanpham)
            ->join('danhmuc', 'sanpham.iddanhmuc', '=', 'danhmuc.id')
            ->select('sanpham.*', 'danhmuc.tendanhmuc')
            ->first();
        $video = DB::table('video')
            ->where('idsanpham', $idsanpham)
            ->first();
        $hinhanh = DB::table('hinhanh')
            ->where('idsanpham', $idsanpham)
            ->get();
        $sanphamlienquan = DB::table('sanpham')
            ->where('sanpham.iddanhmuc', $sanpham->iddanhmuc)
            ->where('sanpham.hidden', 0)
            ->inRandomOrder()
            ->limit(6)
            ->get();
        $khohang = DB::table('khohang')
            ->where('idsanpham', $idsanpham)
            ->first();
        $ssidkhachhang = Session::get('ssidkhachhang');
        $khachhang = DB::table('khachhang')
            ->where('id', $ssidkhachhang)
            ->first();
        return view('frontend.chitietsanpham', compact('thongtinshop', 'danhmuc', 'sanpham', 'video', 'hinhanh', 'sanphamlienquan', 'khachhang', 'khohang'));
    }
    public function giohang()
    {
        $ssidkhachhang = Session::get('ssidkhachhang');
        if ($ssidkhachhang == null) return redirect()->route('index');
        $thongtinshop = DB::table('thongtinshop')
            ->first();
        $danhmuc = DB::table('danhmuc')
            ->where('hidden', 0)
            ->get();
        $sanphamlienquan = DB::table('sanpham')
            ->where('sanpham.hidden', 0)
            ->inRandomOrder()
            ->limit(6)
            ->get();
        $khachhang = DB::table('khachhang')
            ->where('id', $ssidkhachhang)
            ->first();
        $chitietgiohang = DB::table('chitietgiohang')
            ->where('idkhachhang', $ssidkhachhang)
            ->join('sanpham', 'chitietgiohang.idsanpham', '=', 'sanpham.id')
            ->select('chitietgiohang.*', 'sanpham.tensanpham', 'sanpham.anhsanpham', 'sanpham.dongiasanpham')
            ->get();
        $thanhtien = 0;
        $donhang = DB::table('donhang')
            ->orderBy('ngaydathang', 'desc')
            ->where('idkhachhang', $ssidkhachhang)
            ->simplepaginate(10);
        $chitietdonhang = DB::table('chitietdonhang')
            ->where('idkhachhang', $ssidkhachhang)
            ->get();
        return view('frontend.giohang', compact('thongtinshop', 'danhmuc', 'sanphamlienquan', 'khachhang', 'chitietgiohang', 'thanhtien', 'donhang', 'chitietdonhang'));
    }
    public function capnhatgiohang(Request $request)
    {
        $ssidkhachhang = Session::get('ssidkhachhang');
        if ($ssidkhachhang == null) return redirect()->route('index');
        $chitietgiohang['soluongsanpham'] = $request->soluongsanpham;
        DB::table('chitietgiohang')
            ->where('id', $request->idsanpham)
            ->update($chitietgiohang);
        return back();
    }
    public function deletegiohang(Request $request)
    {
        $ssidkhachhang = Session::get('ssidkhachhang');
        if ($ssidkhachhang == null) return redirect()->route('index');
        DB::table('chitietgiohang')
            ->where('id', $request->idsanpham)
            ->where('idkhachhang', $ssidkhachhang)
            ->delete();
        return back();
    }

    public function huydonhang(Request $request)
    {
        $ssidkhachhang = Session::get('ssidkhachhang');
        if ($ssidkhachhang == null) return redirect()->route('index');
        $donhang['trangthaidonhang'] = 4;
        DB::table('donhang')
            ->where('idkhachhang', $ssidkhachhang)
            ->where('id', $request->iddonhang)
            ->update($donhang);
        return back();
    }
}
