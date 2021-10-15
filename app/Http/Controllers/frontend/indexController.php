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
    public function loginkhachhang(Request $request)
    {
        $idsanpham = $request->idsanpham;
        return view('frontend.loginkhachhang', compact('idsanpham'));
    }

    public function registerkhachhang()
    {
        return view('frontend.registerkhachhang');
    }

    public function dangxuatkhachhang()
    {
        Session::forget('ssidkhachhang');
        return back();
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
            if ($request->idsanpham) {
                $idsanpham = $request->idsanpham;
                return redirect()->route('chitietsanpham', ['idsanpham' => $idsanpham]);
                // return redirect()->route('chitietsanpham', compact('idsanpham'));
            } else {
                return redirect()->route('index');
            }
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
    public function index(Request $request)
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
            ->simplePaginate(6);

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
        return view('frontend.index', compact('thongtinshop', 'danhmuc', 'sanpham', 'khachhang', 'soluonggiohang'));
    }

    public function sanphamdanhmuc(Request $request)
    {
        $iddanhmuc = $request->iddanhmuc;
        $sapxep = $request->sapxep;
        $thongtinshop = DB::table('thongtinshop')
            ->first();
        $danhmuc = DB::table('danhmuc')
            ->where('hidden', 0)
            ->get();
        $danhmuc2 = DB::table('danhmuc')
            ->where('id', $iddanhmuc)
            ->first();
        $tendanhmuc = $danhmuc2->tendanhmuc;

        // Khong sap xep
        if($sapxep == 0){
            if($danhmuc2->danhmuccha == 0){
                $danhmuc3 = DB::table('danhmuc')->where('danhmuccha', $danhmuc2->id)->get();
                $sanphamdanhmuc = null;
                if($danhmuc3){
                    foreach($danhmuc3 as $key => $rowdanhmuc3){
                    $sanphamdanhmuc[$key] = DB::table('sanpham')// moi $key la 1 iddanhmuc khac nhau (cotloi cong mang la [$key])
                    // ->where('iddanhmuc', $danhmuc3[$key]->id)
                    ->where('iddanhmuc', $rowdanhmuc3->id)
                    ->join('danhmuc', 'sanpham.iddanhmuc', '=', 'danhmuc.id')
                    ->where('sanpham.hidden', 0)
                    ->inRandomOrder()
                    ->select('sanpham.*', 'danhmuc.tendanhmuc')
                    ->get();
                    }
                }
                $sanpham = null;
            }else{
                $sanphamdanhmuc = null;
                $sanpham = DB::table('sanpham')
                ->where('iddanhmuc', $iddanhmuc)
                ->join('danhmuc', 'sanpham.iddanhmuc', '=', 'danhmuc.id')
                ->orderBy('sanpham.id', 'desc')
                ->where('sanpham.hidden', 0)
                ->select('sanpham.*', 'danhmuc.tendanhmuc')
                ->simplePaginate(12);
            }
        }

        // A den Z
        if ($sapxep == 1) {
            if ($danhmuc2->danhmuccha == 0) {
                $danhmuc3 = DB::table('danhmuc')->where('danhmuccha', $danhmuc2->id)->get();
                foreach ($danhmuc3 as $key => $rowdanhmuc3) {
                    $sanphamdanhmuc[$key] = DB::table('sanpham') // moi $key la 1 iddanhmuc khac nhau (cotloi cong mang la [$key])
                        // ->where('iddanhmuc', $danhmuc3[$key]->id)
                        ->where('iddanhmuc', $rowdanhmuc3->id)
                        ->join('danhmuc', 'sanpham.iddanhmuc', '=', 'danhmuc.id')
                        ->where('sanpham.hidden', 0)
                        ->inRandomOrder()
                        ->select('sanpham.*', 'danhmuc.tendanhmuc')
                        ->get();
                }
                $sanpham = null;
            } else {
                $sanphamdanhmuc = null;
                $sanpham = DB::table('sanpham')
                ->where('iddanhmuc', $iddanhmuc)
                ->join('danhmuc', 'sanpham.iddanhmuc', '=', 'danhmuc.id')
                ->orderBy('sanpham.tensanpham', 'asc')
                ->where('sanpham.hidden', 0)
                ->select('sanpham.*', 'danhmuc.tendanhmuc')
                ->simplePaginate(12);
            }
        }

        // Z den A
        if ($sapxep == 2) {
            if ($danhmuc2->danhmuccha == 0) {
                $danhmuc3 = DB::table('danhmuc')->where('danhmuccha', $danhmuc2->id)->get();
                foreach ($danhmuc3 as $key => $rowdanhmuc3) {
                    $sanphamdanhmuc[$key] = DB::table('sanpham') // moi $key la 1 iddanhmuc khac nhau (cotloi cong mang la [$key])
                        // ->where('iddanhmuc', $danhmuc3[$key]->id)
                        ->where('iddanhmuc', $rowdanhmuc3->id)
                        ->join('danhmuc', 'sanpham.iddanhmuc', '=', 'danhmuc.id')
                        ->where('sanpham.hidden', 0)
                        ->inRandomOrder()
                        ->select('sanpham.*', 'danhmuc.tendanhmuc')
                        ->get();
                }
                $sanpham = null;
            } else {
                $sanphamdanhmuc = null;
                $sanpham = DB::table('sanpham')
                    ->where('iddanhmuc', $iddanhmuc)
                    ->join('danhmuc', 'sanpham.iddanhmuc', '=', 'danhmuc.id')
                    ->orderBy('sanpham.tensanpham', 'desc')
                    ->where('sanpham.hidden', 0)
                    ->select('sanpham.*', 'danhmuc.tendanhmuc')
                    ->simplePaginate(12);
            }
        }

        // Thap den cao
        if ($sapxep == 3) {
            if ($danhmuc2->danhmuccha == 0) {
                $danhmuc3 = DB::table('danhmuc')->where('danhmuccha', $danhmuc2->id)->get();
                foreach ($danhmuc3 as $key => $rowdanhmuc3) {
                    $sanphamdanhmuc[$key] = DB::table('sanpham') // moi $key la 1 iddanhmuc khac nhau (cotloi cong mang la [$key])
                        // ->where('iddanhmuc', $danhmuc3[$key]->id)
                        ->where('iddanhmuc', $rowdanhmuc3->id)
                        ->join('danhmuc', 'sanpham.iddanhmuc', '=', 'danhmuc.id')
                        ->where('sanpham.hidden', 0)
                        ->inRandomOrder()
                        ->select('sanpham.*', 'danhmuc.tendanhmuc')
                        ->get();
                }
                $sanpham = null;
            } else {
                $sanphamdanhmuc = null;
                $sanpham = DB::table('sanpham')
                    ->where('iddanhmuc', $iddanhmuc)
                    ->join('danhmuc', 'sanpham.iddanhmuc', '=', 'danhmuc.id')
                    ->orderBy('sanpham.dongiasanpham', 'asc')
                    ->where('sanpham.hidden', 0)
                    ->select('sanpham.*', 'danhmuc.tendanhmuc')
                    ->simplePaginate(12);
            }
        }

        // Cao den thap
        if ($sapxep == 4) {
            if ($danhmuc2->danhmuccha == 0) {
                $danhmuc3 = DB::table('danhmuc')->where('danhmuccha', $danhmuc2->id)->get();
                foreach ($danhmuc3 as $key => $rowdanhmuc3) {
                    $sanphamdanhmuc[$key] = DB::table('sanpham') // moi $key la 1 iddanhmuc khac nhau (cotloi cong mang la [$key])
                        // ->where('iddanhmuc', $danhmuc3[$key]->id)
                        ->where('iddanhmuc', $rowdanhmuc3->id)
                        ->join('danhmuc', 'sanpham.iddanhmuc', '=', 'danhmuc.id')
                        ->where('sanpham.hidden', 0)
                        ->inRandomOrder()
                        ->select('sanpham.*', 'danhmuc.tendanhmuc')
                        ->get();
                }
                $sanpham = null;
            } else {
                $sanphamdanhmuc = null;
                $sanpham = DB::table('sanpham')
                    ->where('iddanhmuc', $iddanhmuc)
                    ->join('danhmuc', 'sanpham.iddanhmuc', '=', 'danhmuc.id')
                    ->orderBy('sanpham.dongiasanpham', 'desc')
                    ->where('sanpham.hidden', 0)
                    ->select('sanpham.*', 'danhmuc.tendanhmuc')
                    ->simplePaginate(12);
            }
        }
        
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
        return view('frontend.sanphamdanhmuc', compact('thongtinshop', 'danhmuc', 'iddanhmuc', 'tendanhmuc', 'sanphamdanhmuc', 'sanpham', 'khachhang', 'soluonggiohang'));
    }

    public function timkiemsanpham(Request $request)
    {
        $tukhoa = $request->tukhoa;
        $thongtinshop = DB::table('thongtinshop')
        ->first();
        $danhmuc = DB::table('danhmuc')
        ->where('hidden', 0)
            ->get();
        $iddanhmuc = 0;
        $tendanhmuc = $tukhoa;

        $sanphamdanhmuc = null;
        $sanpham = DB::table('sanpham')
            ->join('danhmuc', 'sanpham.iddanhmuc', '=', 'danhmuc.id')
            ->where('sanpham.hidden', 0)
            ->where('sanpham.tensanpham', 'like', '%'.$tukhoa.'%')
            ->select('sanpham.*', 'danhmuc.tendanhmuc')
            ->simplePaginate(12);

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
        return view('frontend.sanphamdanhmuc', compact('thongtinshop', 'danhmuc', 'iddanhmuc', 'tendanhmuc', 'sanphamdanhmuc', 'sanpham', 'khachhang', 'soluonggiohang'));
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
        $soluonggiohang = 0;
        $giohang = DB::table('chitietgiohang')
            ->where('idkhachhang', $ssidkhachhang)
            ->get();
        foreach ($giohang as $rowgiohang) {
            $soluonggiohang = $soluonggiohang + $rowgiohang->soluongsanpham;
        }
        return view('frontend.chitietsanpham', compact('thongtinshop', 'danhmuc', 'sanpham', 'video', 'hinhanh', 'sanphamlienquan', 'khachhang', 'khohang', 'soluonggiohang'));
    }

    public function muangay(Request $request)
    {
        $ssidkhachhang = Session::get('ssidkhachhang');
        $idsanpham = $request->idsanpham;
        if ($ssidkhachhang == null) return redirect()->route('loginkhachhang', compact('idsanpham'));
        $thongtinshop = DB::table('thongtinshop')
            ->first();
        $danhmuc = DB::table('danhmuc')
            ->where('hidden', 0)
            ->get();
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
        $sanpham = DB::table('sanpham')
            ->where('id', $request->idsanpham)
            ->first();
        return view('frontend.muangay', compact('thongtinshop', 'danhmuc', 'khachhang',  'soluonggiohang', 'sanpham'));
    }

    public function domuangay(Request $request)
    {
        $ssidkhachhang = Session::get('ssidkhachhang');
        $donhang['idkhachhang'] = $ssidkhachhang;
        $donhang['ngaydathang'] = date('y-m-d');
        $donhang['diachigiaohang'] = $request->diachigiaohang;
        $donhang['thanhtiendonhang'] = $request->thanhtiendonhang;
        $donhang['trangthaidonhang'] = 0;
        $iddonhang = DB::table('donhang')->insertgetID($donhang);

        $chitietdonhang['idkhachhang'] = $ssidkhachhang;
        $chitietdonhang['iddonhang'] = $iddonhang;
        $sanpham = DB::table('sanpham')
            ->where('id', $request->idsanpham)
            ->first();
        $chitietdonhang['idsanpham'] = $request->idsanpham;
        $chitietdonhang['tensanpham'] = $sanpham->tensanpham;
        $chitietdonhang['anhsanpham'] = $sanpham->anhsanpham;
        $chitietdonhang['dongiasanpham'] = $sanpham->dongiasanpham;
        $chitietdonhang['soluongsanpham'] = 1;
        $chitietdonhang['thanhtiensanpham'] = $sanpham->dongiasanpham;
        DB::table('chitietdonhang')->insert($chitietdonhang);
        return redirect()->route('giohang');
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
        $soluonggiohang = 0;
        $giohang = DB::table('chitietgiohang')
            ->where('idkhachhang', $ssidkhachhang)
            ->get();
        foreach ($giohang as $rowgiohang) {
            $soluonggiohang = $soluonggiohang + $rowgiohang->soluongsanpham;
        }
        return view('frontend.giohang', compact('thongtinshop', 'danhmuc', 'sanphamlienquan', 'khachhang', 'chitietgiohang', 'thanhtien', 'donhang', 'chitietdonhang', 'soluonggiohang'));
    }

    public function themvaogiohang(Request $request)
    {
        $ssidkhachhang = Session::get('ssidkhachhang');
        $idsanpham = $request->idsanpham;
        if ($ssidkhachhang == null) return redirect()->route('loginkhachhang', compact('idsanpham'));
        $chitietgiohang['idkhachhang'] = $ssidkhachhang;
        $chitietgiohang['idsanpham'] = $request->idsanpham;
        $chitietgiohang['soluongsanpham'] = 1;
        $check = DB::table('chitietgiohang')
            ->where('idkhachhang', $ssidkhachhang)
            ->where('idsanpham', $request->idsanpham)
            ->first();
        if ($check == null) {
            DB::table('chitietgiohang')->insert($chitietgiohang);
            return back();
        } else {
            $chitietgiohang['soluongsanpham'] = $check->soluongsanpham + 1;
            DB::table('chitietgiohang')
                ->where('id', $check->id)
                ->update($chitietgiohang);
            return back();
        }
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

    public function dathang(Request $request)
    {
        $ssidkhachhang = Session::get('ssidkhachhang');
        $thanhtiendonhang = $request->thanhtiendonhang;
        $thongtinshop = DB::table('thongtinshop')
            ->first();
        $danhmuc = DB::table('danhmuc')
            ->where('hidden', 0)
            ->get();
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
        $chitietgiohang = DB::table('chitietgiohang')
            ->where('idkhachhang', $ssidkhachhang)
            ->join('sanpham', 'chitietgiohang.idsanpham',  '=', 'sanpham.id')
            ->select('chitietgiohang.*', 'sanpham.tensanpham', 'sanpham.anhsanpham', 'sanpham.dongiasanpham')
            ->get();
        return view('frontend.dathang', compact('thongtinshop', 'danhmuc', 'khachhang',  'soluonggiohang', 'chitietgiohang', 'thanhtiendonhang'));
    }

    public function dodathang(Request $request)
    {
        $ssidkhachhang = Session::get('ssidkhachhang');
        $donhang['idkhachhang'] = $ssidkhachhang;
        $donhang['ngaydathang'] = date('y-m-d');
        $donhang['diachigiaohang'] = $request->diachigiaohang;
        $donhang['thanhtiendonhang'] = $request->thanhtiendonhang;
        $donhang['trangthaidonhang'] = 0;
        $iddonhang = DB::table('donhang')->insertgetID($donhang);

        $chitietgiohang = DB::table('chitietgiohang')
            ->where('idkhachhang', $ssidkhachhang)
            ->join('sanpham', 'chitietgiohang.idsanpham',  '=', 'sanpham.id')
            ->select('chitietgiohang.*', 'sanpham.tensanpham', 'sanpham.anhsanpham', 'sanpham.dongiasanpham')
            ->get();
        foreach ($chitietgiohang as $rowchitietgiohang) {
            $chitietdonhang['idkhachhang'] = $ssidkhachhang;
            $chitietdonhang['iddonhang'] = $iddonhang;
            $chitietdonhang['idsanpham'] = $rowchitietgiohang->idsanpham;
            $chitietdonhang['tensanpham'] = $rowchitietgiohang->tensanpham;
            $chitietdonhang['anhsanpham'] = $rowchitietgiohang->anhsanpham;
            $chitietdonhang['dongiasanpham'] = $rowchitietgiohang->dongiasanpham;
            $chitietdonhang['soluongsanpham'] = $rowchitietgiohang->soluongsanpham;
            $chitietdonhang['thanhtiensanpham'] = $rowchitietgiohang->dongiasanpham * $rowchitietgiohang->soluongsanpham;\
            DB::table('chitietdonhang')->insert($chitietdonhang);
        }

        DB::table('chitietgiohang')->where('idkhachhang', $ssidkhachhang)->delete();
        return redirect()->route('giohang');
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

        //cap nhat uy tin khach hang
        $tatcadonhang = DB::table('donhang')
            ->where('idkhachhang', $ssidkhachhang)
            ->get();
        $donhangthanhcong = DB::table('donhang')
            ->where('idkhachhang', $ssidkhachhang)
            ->where('trangthaidonhang', 3)
            ->get();
        $uytinkhachhang = count($donhangthanhcong) / count($tatcadonhang) * 100;

        $khachhang['uytinkhachhang'] = $uytinkhachhang;
        DB::table('khachhang')
            ->where('id', $ssidkhachhang)
            ->update($khachhang);
        return back();
    }
}
