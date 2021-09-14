<?php

namespace App\Http\Controllers\admin\khohang;

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

class quanlykhohangController extends Controller
{
    public function quanlykhohang()
    {
        $id = Auth::user()->id;
        $thongtinshop = DB::table('thongtinshop')
            ->where('id', $id)
            ->first();
        $khohang = DB::table('khohang')
            ->where('idusers', $id)
            ->get();
        $sanpham = DB::table('sanpham')
            ->where('idusers', $id)
            ->get();
        return view('admin.khohang.quanlykhohang', compact('thongtinshop', 'khohang', 'sanpham'));
    }
    public function addkhohang(Request $request)
    {
        $id = Auth::user()->id;
        $khohang['idusers'] =  $id;
        $khohang['idsanpham'] = $request->idsanpham;
        $sanpham = DB::table('sanpham')
            ->where('id', $request->idsanpham)
            ->first();
        $khohang['tensanpham'] = $sanpham->tensanpham;
        $khohang['dongianhap'] = $request->dongianhap;
        $khohang['soluongnhap'] = $request->soluongnhap;
        $khohang['thanhtiennhap'] = $request->dongianhap * $request->soluongnhap;
        $khohang['ngaynhap'] = date('y-m-d');
        $khohang['nguongocnhap'] = $request->nguongocnhap;
        $khohang = DB::table('khohang')->insert($khohang);
        return back();
    }
    public function editkhohang(Request $request)
    {
        $id = Auth::user()->id;
        $check = DB::table('khohang')
            ->where('idusers', $id)
            ->where('tenkhohang', $request->tenkhohang)
            ->first();
        if ($check) return back()->withErrors('Tên lĩnh vực bị trùng');
        else {
            $khohang['tenkhohang'] = $request->tenkhohang;
            DB::table('khohang')
                ->where('id', $id)
                ->update($khohang);
        }
        return back();
    }
    public function hiddenkhohang($idkhohang)
    {
        $id = Auth::user()->id;
        $khohang['hidden'] = 1;
        DB::table('khohang')
            ->where('id', $idkhohang)
            ->where('idusers', $id)
            ->update($khohang);
        return back();
    }
    public function showkhohang($idkhohang)
    {
        $id = Auth::user()->id;
        $khohang['hidden'] = 0;
        DB::table('khohang')
            ->where('id', $idkhohang)
            ->where('idusers', $id)
            ->update($khohang);
        return back();
    }
    public function deletekhohang($idkhohang)
    {
        $id = Auth::user()->id;
        DB::table('khohang')
            ->where('id', $idkhohang)
            ->where('idusers', $id)
            ->delete();
        return back();
    }
}
