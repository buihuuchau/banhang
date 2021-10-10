<?php

namespace App\Http\Controllers\admin\ngansach;

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
use DateTime;


class quanlyngansachController extends Controller
{
    public function quanlyngansach()
    {
        $id = Auth::user()->id;
        $thongtinshop = DB::table('thongtinshop')
            ->where('id', $id)
            ->first();
        $nhaphang = null;
        $donhang = null;
        return view('admin.ngansach.quanlyngansach', compact('thongtinshop', 'nhaphang', 'donhang'));
    }

    public function thongkenhaphang(Request $request)
    {
        $id = Auth::user()->id;
        $thongtinshop = DB::table('thongtinshop')
            ->where('id', $id)
            ->first();

        $donhang = null;

        $tungay = $request->tungay;
        $denngay = $request->denngay;
        if ($tungay == null) {
            $tungay = date('Y-m-01');
        }
        if ($denngay == null) {
            $denngay = date('Y-m-t');
        }


        $nhaphang = DB::table('nhaphang')
            ->orderBy('tensanpham')
            ->whereBetween('ngaynhap', [$tungay, $denngay])
            ->get();
        $tong = 0;
        foreach ($nhaphang as $rownhaphang) {
            $tong = $tong + $rownhaphang->thanhtiennhap;
        }


        $tungay2 = new DateTime($tungay);
        $tungay3 = date_format($tungay2, 'Y');
        $tungay4 = substr($tungay, 0, 4);
        $total = array();
        for ($i = 1; $i <= 12; $i++) {
            $nhaphang2 = DB::table('nhaphang')
                ->where('ngaynhap', 'like', $tungay3 . '-0' . $i . '-%')
                ->orWhere('ngaynhap', 'like', $tungay3 . '-' . $i . '-%')
                ->get();
            $total[$i] = 0;
            foreach ($nhaphang2 as $rownhaphang2) {
                $total[$i] = $total[$i] + $rownhaphang2->thanhtiennhap;
            }
        }


        $thang1 = $total[1];
        $thang2 = $total[2];
        $thang3 = $total[3];
        $thang4 = $total[4];
        $thang5 = $total[5];
        $thang6 = $total[6];
        $thang7 = $total[7];
        $thang8 = $total[8];
        $thang9 = $total[9];
        $thang10 = $total[10];
        $thang11 = $total[11];
        $thang12 = $total[12];





        return view('admin.ngansach.quanlyngansach', compact(
            'thongtinshop',
            'nhaphang',
            'donhang',
            'tong',
            'total',
            'tungay',
            'denngay',
            'thang1',
            'thang2',
            'thang3',
            'thang4',
            'thang5',
            'thang6',
            'thang7',
            'thang8',
            'thang9',
            'thang10',
            'thang11',
            'thang12'
        ));
    }

    public function thongkebanhang(Request $request)
    {
        $id = Auth::user()->id;
        $thongtinshop = DB::table('thongtinshop')
            ->where('id', $id)
            ->first();

        $nhaphang = null;


        $tungay = $request->tungay;
        $denngay = $request->denngay;
        if ($tungay == null) {
            $tungay = date('Y-m-01');
        }
        if ($denngay == null) {
            $denngay = date('Y-m-t');
        }


        $donhang = DB::table('donhang')
            ->whereBetween('ngaydathang', [$tungay, $denngay])
            ->get();
        $tongthanhtien = 0;
        foreach ($donhang as $key => $rowdonhang) {
            $tongthanhtien = $tongthanhtien + $rowdonhang->thanhtiendonhang;
        }


        $tungay2 = new DateTime($tungay);
        $tungay3 = date_format($tungay2, 'Y');
        $totalthanhtien = array();
        for ($i = 1; $i <= 12; $i++) {
            $donhang2 = DB::table('donhang')
                ->where('ngaydathang', 'like', $tungay3 . '-0' . $i . '-%')
                ->orWhere('ngaydathang', 'like', $tungay3 . '-' . $i . '-%')
                ->get();
            $totalthanhtien[$i] = 0;
            foreach ($donhang2 as $rowdonhang2) {
                $totalthanhtien[$i] = $totalthanhtien[$i] + $rowdonhang2->thanhtiendonhang;
            }
        }


        $thang1thanhtien = $totalthanhtien[1];
        $thang2thanhtien = $totalthanhtien[2];
        $thang3thanhtien = $totalthanhtien[3];
        $thang4thanhtien = $totalthanhtien[4];
        $thang5thanhtien = $totalthanhtien[5];
        $thang6thanhtien = $totalthanhtien[6];
        $thang7thanhtien = $totalthanhtien[7];
        $thang8thanhtien = $totalthanhtien[8];
        $thang9thanhtien = $totalthanhtien[9];
        $thang10thanhtien = $totalthanhtien[10];
        $thang11thanhtien = $totalthanhtien[11];
        $thang12thanhtien = $totalthanhtien[12];



        $banchay = array();
        $i = 0;
        $sumbanchay = 0;

        $donhang3 = DB::table('donhang')
            ->where('thanhtiendonhang', '!=', 0)
            ->whereBetween('ngaydathang', [$tungay, $denngay])
            ->get();
        $chitietdonhang = DB::table('chitietdonhang')
            ->get();
        foreach ($donhang3 as $key3 => $rowdonhang3) {
            foreach ($chitietdonhang as $key => $rowchitietdonhang) {
                if ($rowchitietdonhang->iddonhang == $rowdonhang3->id) {
                    $soluong = 0;
                    $soluong = $soluong + $rowchitietdonhang->soluongsanpham;
                    $banchay[$i]['soluongsanpham'] = $soluong;
                    $banchay[$i]['tensanpham'] = $rowchitietdonhang->tensanpham;
                    $banchay[$i]['dongiasanpham'] = $rowchitietdonhang->dongiasanpham;
                    $sumbanchay = $sumbanchay + $rowchitietdonhang->soluongsanpham;
                    $i++;
                }
            }
        }


        $hanghong = array();
        $y = 0;
        $sumhong = 0;

        $donhang4 = DB::table('donhang')
            ->where('thanhtiendonhang', 0)
            ->whereBetween('ngaydathang', [$tungay, $denngay])
            ->get();
        $chitietdonhang2 = DB::table('chitietdonhang')
            ->get();
        foreach ($donhang4 as $key4 => $rowdonhang4) {
            foreach ($chitietdonhang2 as $key2 => $rowchitietdonhang2) {
                if ($rowchitietdonhang2->iddonhang == $rowdonhang4->id) {
                    $soluong = 0;
                    $soluong = $soluong + $rowchitietdonhang2->soluongsanpham;
                    $hanghong[$y]['soluongsanpham'] = $soluong;
                    $hanghong[$y]['tensanpham'] = $rowchitietdonhang2->tensanpham;
                    $hanghong[$y]['dongiasanpham'] = $rowchitietdonhang2->dongiasanpham;
                    $sumhong = $sumhong + $rowchitietdonhang2->soluongsanpham;
                    $y++;
                }
            }
        }


        return view('admin.ngansach.quanlyngansach', compact(
            'thongtinshop',
            'nhaphang',
            'donhang',
            'tongthanhtien',
            'totalthanhtien',
            'tungay',
            'denngay',
            'banchay',
            'sumbanchay',
            'hanghong',
            'sumhong',
            'thang1thanhtien',
            'thang2thanhtien',
            'thang3thanhtien',
            'thang4thanhtien',
            'thang5thanhtien',
            'thang6thanhtien',
            'thang7thanhtien',
            'thang8thanhtien',
            'thang9thanhtien',
            'thang10thanhtien',
            'thang11thanhtien',
            'thang12thanhtien',
        ));
    }
}
