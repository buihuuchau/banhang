<?php

namespace App\Http\Controllers\admin\nhaphang;

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

class quanlynhaphangController extends Controller
{
    public function quanlynhaphang()
    {
        $id = Auth::user()->id;
        $thongtinshop = DB::table('thongtinshop')
            ->where('id', $id)
            ->first();
        $nhaphang = DB::table('nhaphang')
            ->where('idusers', $id)
            ->get();
        $sanpham = DB::table('sanpham')
            ->where('idusers', $id)
            ->get();
        return view('admin.nhaphang.quanlynhaphang', compact('thongtinshop', 'nhaphang', 'sanpham'));
    }
    public function addhang(Request $request)
    {
        $id = Auth::user()->id;
        $sanpham = DB::table('sanpham')
            ->where('id', $request->idsanpham)
            ->first();
        $nhaphang['idusers'] =  $id;
        $nhaphang['idsanpham'] = $request->idsanpham;
        $nhaphang['tensanpham'] = $sanpham->tensanpham;
        $nhaphang['dongianhap'] = $request->dongianhap;
        $nhaphang['soluongnhap'] = $request->soluongnhap;
        $nhaphang['thanhtiennhap'] = $request->dongianhap * $request->soluongnhap;
        $nhaphang['ngaynhap'] = date('y-m-d');
        $nhaphang['nguongocnhap'] = $request->nguongocnhap;
        $nhaphang = DB::table('nhaphang')->insert($nhaphang);

        $check = DB::table('khohang')
            ->where('idsanpham', $request->idsanpham)
            ->first();
        if ($check == null) {
            $khohang['idusers'] = $id;
            $khohang['idsanpham'] = $request->idsanpham;
            $khohang['tensanpham'] = $sanpham->tensanpham;
            $khohang['soluonghang'] = $request->soluongnhap;
            $khohang['soluongconlai'] = $request->soluongnhap;
            DB::table('khohang')->insert($khohang);
        } else {
            $khohang['tensanpham'] = $sanpham->tensanpham;
            $khohang['soluonghang'] = $check->soluonghang + $request->soluongnhap;
            $khohang['soluongconlai'] = $check->soluongconlai + $request->soluongnhap;
            DB::table('khohang')
                ->where('idsanpham', $request->idsanpham)
                ->update($khohang);
        }
        return back();
    }

    public function deletehang(Request $request)
    {
        $id = Auth::user()->id;
        DB::table('nhaphang')
            ->where('id', $request->idnhaphang)
            ->delete();
        $check = DB::table('khohang')
            ->where('idsanpham', $request->idsanpham)
            ->first();
        if ($check->soluonghang - $request->soluongnhap <= 0) {
            DB::table('khohang')
                ->where('idsanpham', $request->idsanpham)
                ->delete();
        } else {
            $khohang['soluonghang'] = $check->soluonghang - $request->soluongnhap;
            DB::table('khohang')
                ->where('idsanpham', $request->idsanpham)
                ->update($khohang);
        }
        return back();
    }
}
