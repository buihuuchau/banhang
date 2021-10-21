<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use App\Models\danhmuccha;
use App\Models\danhmuccon;
use App\Models\test;
use Illuminate\Http\Request;
use DB;
use Session;

class testController extends Controller
{
    public function test()
    {
        $danhmuccha = danhmuccha::all();
        $danhmuccon = danhmuccon::all();
        return view('test.test', compact('danhmuccha', 'danhmuccon'));
    }
    public function testdangky(Request $request)
    {
        $test = test::create([
            'sdt' => $request->sdt,
            'name' => $request->name,
            'sex' => $request->sex,
            'ngaysinh' => $request->ngaysinh,
        ]);
        return back();
    }
    public function danhmuccon($iddanhmuccha)
    {
        $danhmuccon = danhmuccon::where('iddanhmuccha', $iddanhmuccha)->get();
        foreach ($danhmuccon as $rowdanhmuccon) {
            echo "<option value='" .   $rowdanhmuccon->id  . "'>" .  $rowdanhmuccon->tendanhmuccon   . "</option>";
        }
    }


    public function testshowsanpham(Request $request)
    {
        $thongtinshop = DB::table('thongtinshop')
            ->first();
        $danhmuc = DB::table('danhmuc')
            ->where('hidden', 0)
            ->get();
        $sanpham = DB::table('sanpham')
            ->orderBy('sanpham.id', 'desc')
            ->join('danhmuc', 'sanpham.iddanhmuc', '=', 'danhmuc.id')
            ->where('sanpham.hidden', 0)
            ->where('sanpham.sanphamnoibat', 1)
            ->select('sanpham.*', 'danhmuc.tendanhmuc')
            ->simplePaginate(4);

        $ssidkhachhang = Session::get('ssidkhachhang');
        $khachhang = DB::table('khachhang')
            ->where('id', $ssidkhachhang)
            ->first();
        $soluonggiohang = 0;
        $giohang = DB::table('chitietgiohang')
            ->where('idkhachhang', $ssidkhachhang)
            ->get();
        foreach ($giohang as $rowgiohang) {
            $soluonggiohang = $soluonggiohang + $rowgiohang->soluongsanpham;
        }
        $artilces = '';
        if ($request->ajax()) {
            foreach ($sanpham as $rowsanpham) {
                $artilces .=
                    '
                        <div class="col-md-3">
                            <div class="blog-box">
                                <div class="post-media">
                                    <a href="
                                        chitietsanpham/' . $rowsanpham->id . '
                                    ">
                                        <img src="' . $rowsanpham->anhsanpham . '" height="212px">
                                        <div class="hovereffect">
                                            <span></span>
                                        </div>
                                    </a>
                                </div>
                                <div class="blog-meta big-meta">
                                    <span class="color-orange"><a href="sanphamdanhmuc/' . $rowsanpham->iddanhmuc . '">' . $rowsanpham->tendanhmuc . '</a></span>
                                    <h4><a href="chitietsanpham/' . $rowsanpham->id . '">' . $rowsanpham->tensanpham . '</a></h4>
                                    <b style="color:blue">' . $rowsanpham->dongiasanpham . 'VNĐ/' . $rowsanpham->donvitinhsanpham . '</b>
                                </div>
                            </div>
                        </div>
                    ';
            }
            return $artilces;
        }
        return view('test.testshowsanpham', compact('thongtinshop', 'danhmuc', 'sanpham', 'khachhang', 'soluonggiohang'));
    }

    public function testregister()
    {
        return view('test.testregister');
    }
    public function checkacc(Request $request)
    {
        if ($request->ajax()) {
            $check = DB::table('users')->where('email', $request->acc)->first();
            if ($check==null) echo "check";
            else echo "x";
        }
    }
}
