<?php

namespace App\Http\Controllers\admin\sanpham;

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

class quanlysanphamController extends Controller
{
    public function quanlysanpham()
    {
        $id = Auth::user()->id;
        $thongtinshop = DB::table('thongtinshop')
            ->where('id', $id)
            ->first();
        $sudung = null;
        $danhmuc = DB::table('danhmuc')
            ->where('idusers', $id)
            ->get();
        $sanpham = DB::table('sanpham')
            ->where('idusers', $id)
            ->get();
        $callfunction = new myfunction($danhmuc);
        $htmlOption = $callfunction->xemdanhmuc();
        return view('admin.sanpham.quanlysanpham', compact('thongtinshop', 'sudung', 'danhmuc', 'sanpham', 'htmlOption'));
    }
    public function addsanpham(Request $request)
    {
        $id = Auth::user()->id;
        $check = DB::table('sanpham')
            ->where('idusers', $id)
            ->where('iddanhmuc', $request->iddanhmuc)
            ->where('tensanpham', $request->tensanpham)
            ->first();
        if ($check) return back()->withErrors('Tên sản phẩm bị trùng');
        else {
            $sanpham['idusers'] = $id;
            $sanpham['iddanhmuc'] = $request->iddanhmuc;
            $sanpham['tensanpham'] = $request->tensanpham;
            $sanpham['thongtinsanpham'] = $request->thongtinsanpham;
            $sanpham['xuatxusanpham'] = $request->xuatxusanpham;
            $sanpham['dongiasanpham'] = $request->dongiasanpham;
            $sanpham['donvitinhsanpham'] = $request->donvitinhsanpham;
            // $idsanpham = DB::table('sanpham')->insertgetID($sanpham);
        }

        request()->validate(
            [
                'dulieuvideo' => 'mimes:flv,mp4,avi,ts,mov|max:51200',
            ],
            [
                'dulieuvideo.mimes' => 'Video phải có dạng mp4,avi,ts,mov',
                'dulieuvideo.max' => 'Video phải có dung lượng dưới 50 mb',
            ]
        );
        request()->validate(
            [
                'dulieuhinhanh.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            ],
            [
                'dulieuhinhanh.*.image' => 'Hình ảnh phải có dạng jpg,jpeg,png',
                'dulieuhinhanh.*.max' => 'Hình ảnh phải có độ phân giải dưới 5 mb',
            ]
        );

        $idsanpham = DB::table('sanpham')->insertgetID($sanpham);

        $dulieuvideo = $request->dulieuvideo;
        $dulieuhinhanh = $request->dulieuhinhanh;
        if ($dulieuvideo != null) {
            $dulieuvideo = $dulieuvideo->store('public/admin/' . $id);
            $linkdulieuvideo = 'storage' . substr($dulieuvideo, 6);
            $video['idusers'] = $id;
            $video['idsanpham'] = $idsanpham;
            $video['dulieuvideo'] = $linkdulieuvideo;
            DB::table('video')->insert($video);
        }
        if ($dulieuhinhanh != null) {
            foreach ($dulieuhinhanh as $rowdulieuhinhanh) {
                $imgsanpham = $rowdulieuhinhanh->store('public/admin/' . $id);
                $linkimgsanpham = 'storage' . substr($imgsanpham, 6);
                $hinhanh['idusers'] = $id;
                $hinhanh['idsanpham'] = $idsanpham;
                $hinhanh['dulieuhinhanh'] = $linkimgsanpham;
                DB::table('hinhanh')->insert($hinhanh);
            }
        }
        return back();
    }
    public function editdanhmuc(Request $request)
    {
        $id = Auth::user()->id;
        $check = DB::table('danhmuc')
            ->where('idusers', $id)
            ->where('danhmuccha', $request->danhmuccha)
            ->where('tendanhmuc', $request->tendanhmuc)
            ->first();
        if ($check) return back()->withErrors('Tên danh mục bị trùng');
        else {
            $danhmuc['tendanhmuc'] = $request->tendanhmuc;
            $danhmuc['danhmuccha'] = $request->danhmuccha;
            DB::table('danhmuc')
                ->where('id', $request->id)
                ->update($danhmuc);
            return back();
        }
    }
    public function hiddendanhmuc(Request $request)
    {
        $id = Auth::user()->id;
        $iddanhmuc = $request->iddanhmuc;
        $danhmuc['hidden'] = 1;
        DB::table('danhmuc')
            ->where('id', $iddanhmuc)
            ->update($danhmuc);
        return back();
    }
    public function showdanhmuc(Request $request)
    {
        $id = Auth::user()->id;
        $iddanhmuc = $request->iddanhmuc;
        $danhmuc['hidden'] = 0;
        DB::table('danhmuc')
            ->where('id', $iddanhmuc)
            ->update($danhmuc);
        return back();
    }
    public function deletedanhmuc(Request $request)
    {
        $id = Auth::user()->id;
        $iddanhmuc = $request->iddanhmuc;
        DB::table('danhmuc')
            ->where('id', $iddanhmuc)
            ->delete();
        return back();
    }
}
