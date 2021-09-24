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
            ->join('khachhang', 'donhang.idkhachhang', '=', 'khachhang.id')
            ->select('donhang.*', 'khachhang.sdtkhachhang', 'khachhang.uytinkhachhang')
            ->get();
        $donhang2 = DB::table('donhang')
            ->orderBy('donhang.ngaydathang', 'desc')
            ->where('idkhachhang', 0)
            ->where('diachigiaohang', 'null')
            ->where('trangthaidonhang', 3)
            ->get();
        $chitietdonhang = DB::table('chitietdonhang')
            ->get();
        $khohang = DB::table('khohang')
            ->where('soluongconlai', '>', 0)
            ->get();
        return view('admin.donhang.quanlydonhang', compact('thongtinshop', 'donhang', 'donhang2', 'chitietdonhang', 'khohang'));
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
        $chitietdonhang = DB::table('chitietdonhang')
            ->where('iddonhang', $request->iddonhang)
            ->get();
        foreach ($chitietdonhang as $rowchitietdonhang) {
            $idsanpham = $rowchitietdonhang->idsanpham;
            $soluongsanpham = $rowchitietdonhang->soluongsanpham;
            $check = DB::table('khohang')
                ->where('idsanpham', $idsanpham)
                ->first();
            $khohang['soluongban'] = $check->soluongban + $soluongsanpham;
            $khohang['soluongconlai'] = $check->soluongconlai - $soluongsanpham;
            DB::table('khohang')->where('idsanpham', $idsanpham)->update($khohang);
        }

        //cap nhat uy tin khach hang
        $tatcadonhang = DB::table('donhang')
            ->where('idkhachhang', $request->idkhachhang)
            ->get();
        $donhangthanhcong = DB::table('donhang')
            ->where('idkhachhang', $request->idkhachhang)
            ->where('trangthaidonhang', 3)
            ->get();
        $uytinkhachhang = count($donhangthanhcong) / count($tatcadonhang) * 100;

        $khachhang['uytinkhachhang'] = $uytinkhachhang;
        DB::table('khachhang')
        ->where('id', $request->idkhachhang)
            ->update($khachhang);
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
        $khohang = DB::table('khohang')
            ->where('idsanpham', $request->idsanpham)
            ->first();
        if ($khohang == null || $khohang->soluongconlai < $request->soluongsanpham) return back();
        else {
            $khohang2['soluongban'] = $khohang->soluongban + $request->soluongsanpham;
            $khohang2['soluongconlai'] = $khohang->soluongconlai - $request->soluongsanpham;
            DB::table('khohang')->where('idsanpham', $request->idsanpham)->update($khohang2);
        }

        $donhang['idkhachhang'] = 0;
        $donhang['ngaydathang'] = date('y-m-d');
        $donhang['diachigiaohang'] = 'null';
        $donhang['thanhtiendonhang'] = 0;
        $donhang['trangthaidonhang'] = 3;
        $iddonhang = DB::table('donhang')->insertgetID($donhang);

        $chitietdonhang['idkhachhang'] = 0;
        $chitietdonhang['iddonhang'] = $iddonhang;
        $chitietdonhang['idsanpham'] = $request->idsanpham;
        $sanpham = DB::table('sanpham')->where('id', $request->idsanpham)->first();
        if ($sanpham != null) {
            $chitietdonhang['tensanpham'] = $sanpham->tensanpham;
            $chitietdonhang['anhsanpham'] = $sanpham->anhsanpham;
            $chitietdonhang['dongiasanpham'] = $sanpham->dongiasanpham;
            $chitietdonhang['soluongsanpham'] = $request->soluongsanpham;
            $chitietdonhang['thanhtiensanpham'] = 0;
            DB::table('chitietdonhang')->insert($chitietdonhang);
            return back();
        } else {
            $chitietdonhang['tensanpham'] = $khohang->tensanpham;
            $chitietdonhang['anhsanpham'] = 'storage/admin/AnhNull.jpg';
            $chitietdonhang['dongiasanpham'] = 0;
            $chitietdonhang['soluongsanpham'] = $request->soluongsanpham;
            $chitietdonhang['thanhtiensanpham'] = 0;
            DB::table('chitietdonhang')->insert($chitietdonhang);
            return back();
        }
    }
}
