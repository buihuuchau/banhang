<?php

namespace App\Http\Controllers\admin\donhang;

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
use Illuminate\Support\Facades\DB as FacadesDB;

class quanlydonhangController extends Controller
{
    public function quanlydonhang()
    {
        $id = Auth::user()->id;
        $thongtinshop = DB::table('thongtinshop')
            ->where('id', $id)
            ->first();
        $donhang = DB::table('donhang')
            ->orderBy('donhang.ngaydathang', 'desc')
            ->where('donhang.idusers', $id)
            ->join('khachhang', 'donhang.idkhachhang', '=', 'khachhang.id')
            ->select('donhang.*', 'khachhang.sdtkhachhang', 'khachhang.uytinkhachhang')
            ->get();
        $chitietdonhang = DB::table('chitietdonhang')
            ->where('idusers', $id)
            ->get();
        return view('admin.donhang.quanlydonhang', compact('thongtinshop', 'donhang', 'chitietdonhang'));
    }
    public function checkdonggoi(Request $request)
    {
        $donhang['trangthaidonhang'] = 1;
        DB::table('donhang')
            ->where('id', $request->iddonhang)
            ->update($donhang);
        return back();
    }
    public function checkgiaohang(Request $request)
    {
        $donhang['trangthaidonhang'] = 2;
        DB::table('donhang')
            ->where('id', $request->iddonhang)
            ->update($donhang);
        return back();
    }
    public function checkhoanthanh(Request $request)
    {
        $donhang['trangthaidonhang'] = 3;
        DB::table('donhang')
            ->where('id', $request->iddonhang)
            ->update($donhang);
        return back();
    }
    public function checkhuydon(Request $request)
    {
        $donhang['trangthaidonhang'] = 4;
        DB::table('donhang')
            ->where('id', $request->iddonhang)
            ->update($donhang);
        return back();
    }
}
