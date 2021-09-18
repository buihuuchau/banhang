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
        $donhang2 = DB::table('donhang')
            ->orderBy('donhang.ngaydathang', 'desc')
            ->where('idusers', $id)
            ->where('idkhachhang', 0)
            ->where('diachigiaohang', 'null')
            ->where('trangthaidonhang', 3)
            ->get();
        $chitietdonhang = DB::table('chitietdonhang')
            ->where('idusers', $id)
            ->get();
        $sanpham = DB::table('sanpham')
            ->where('idusers', $id)
            ->get();
        return view('admin.donhang.quanlydonhang', compact('thongtinshop', 'donhang', 'donhang2', 'chitietdonhang', 'sanpham'));
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
    public function donhangloi(Request $request)
    {
        $id = Auth::user()->id;
        $donhang['idusers'] = $id;
        $donhang['idkhachhang'] = 0;
        $donhang['ngaydathang'] = date('y-m-d');
        $donhang['diachigiaohang'] = 'null';
        $donhang['thanhtiendonhang'] = 0;
        $donhang['trangthaidonhang'] = 3;
        $iddonhang = DB::table('donhang')->insertgetID($donhang);
        $chitietdonhang['idusers'] = $id;
        $chitietdonhang['iddonhang'] = $iddonhang;
        $chitietdonhang['idsanpham'] = $request->idsanpham;
        $sanpham = DB::table('sanpham')->where('id', $request->idsanpham)->first();
        $chitietdonhang['tensanpham'] = $sanpham->tensanpham;
        $chitietdonhang['anhsanpham'] = $sanpham->anhsanpham;
        $chitietdonhang['dongiasanpham'] = $sanpham->dongiasanpham;
        $chitietdonhang['soluongsanpham'] = $request->soluongsanpham;
        $chitietdonhang['thanhtiensanpham'] = 0;
        DB::table('chitietdonhang')->insert($chitietdonhang);
        $khohang = DB::table('khohang')->where('idsanpham', $request->idsanpham)->first();
        $khohang2['soluongban'] = $khohang->soluongban + $request->soluongsanpham;
        $khohang2['soluongconlai'] = $khohang->soluongconlai - $request->soluongsanpham;
        DB::table('khohang')->where('idsanpham', $request->idsanpham)->update($khohang2);
        return back();
    }
}
