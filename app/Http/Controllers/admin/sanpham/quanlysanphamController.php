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
    public function quanlysanpham(Request $request)
    {
        $id = Auth::user()->id;
        $thongtinshop = DB::table('thongtinshop')
            ->where('id', $id)
            ->first();
        $danhmuc = DB::table('danhmuc')
            ->get();
        $danhmuc2 = DB::table('danhmuc')
            ->where('hidden', 0)
            ->get();
        $sanpham = DB::table('sanpham')
            ->get();
        $callfunction = new myfunction($danhmuc2);
        $htmlOption = $callfunction->xemdanhmuc();

        if ($request->ajax()) {
            $check = DB::table('sanpham')->where('id', $request->idsanpham)->first();
            if ($check->sanphamnoibat == 0) {
                $sanpham2['sanphamnoibat'] = 1;
            } else {
                $sanpham2['sanphamnoibat'] = 0;
            }
            DB::table('sanpham')->where('id', $request->idsanpham)->update($sanpham2);
        }

        return view('admin.sanpham.quanlysanpham', compact('thongtinshop', 'danhmuc', 'sanpham', 'htmlOption'));
    }
    public function addsanpham(Request $request)
    {
        $id = Auth::user()->id;
        $check = DB::table('sanpham')
            ->where('iddanhmuc', $request->iddanhmuc)
            ->where('tensanpham', $request->tensanpham)
            ->first();
        if ($check) return back()->withErrors('Tên sản phẩm bị trùng');
        else {
            request()->validate(
                [
                    'anhsanpham' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
                ],
                [
                    'anhsanpham.image' => 'Hình ảnh phải có dạng jpg,jpeg,png',
                    'anhsanpham.max' => 'Hình ảnh phải có độ phân giải dưới 5 mb',
                ]
            );
            $anhsanpham = $request->anhsanpham;
            if ($anhsanpham != null) {
                $anhsanpham = $anhsanpham->store('public/admin/' . $id);
                $linkanhsanpham = 'storage' . substr($anhsanpham, 6);
                $sanpham['anhsanpham'] = $linkanhsanpham;
            }
            $sanpham['iddanhmuc'] = $request->iddanhmuc;
            $sanpham['tensanpham'] = $request->tensanpham;
            $sanpham['thongtinsanpham'] = $request->thongtinsanpham;
            $sanpham['xuatxusanpham'] = $request->xuatxusanpham;
            $sanpham['dongiasanpham'] = $request->dongiasanpham;
            $sanpham['donvitinhsanpham'] = $request->donvitinhsanpham;
            $sanpham['sanphamnoibat'] = $request->sanphamnoibat;
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
            $video['idsanpham'] = $idsanpham;
            $video['dulieuvideo'] = $linkdulieuvideo;
            DB::table('video')->insert($video);
        }
        if ($dulieuhinhanh != null) {
            if (count($dulieuhinhanh) > 5) return back()->withErrors("Tối đa 5 ảnh cho sản phẩm");
            else {
                foreach ($dulieuhinhanh as $rowdulieuhinhanh) {
                    $imgsanpham = $rowdulieuhinhanh->store('public/admin/' . $id);
                    $linkimgsanpham = 'storage' . substr($imgsanpham, 6);
                    $hinhanh['idsanpham'] = $idsanpham;
                    $hinhanh['dulieuhinhanh'] = $linkimgsanpham;
                    DB::table('hinhanh')->insert($hinhanh);
                }
            }
        }
        return back();
    }
    public function editsanpham(Request $request)
    {
        $id = Auth::user()->id;
        $idsanpham = $request->idsanpham;
        $thongtinshop = DB::table('thongtinshop')
            ->where('id', $id)
            ->first();
        $danhmuc = DB::table('danhmuc')
            ->get();
        $danhmuc2 = DB::table('danhmuc')
            ->where('hidden', 0)
            ->get();
        $sanpham = DB::table('sanpham')
            ->where('id', $idsanpham)
            ->first();
        $video = DB::table('video')
            ->where('idsanpham', $idsanpham)
            ->first();
        $hinhanh = DB::table('hinhanh')
            ->where('idsanpham', $idsanpham)
            ->get();
        $callfunction = new myfunction($danhmuc2);
        $htmlOption = $callfunction->xemdanhmuc();
        return view('admin.sanpham.editsanpham', compact('thongtinshop', 'danhmuc', 'sanpham', 'video', 'hinhanh', 'htmlOption'));
    }
    public function deletedulieuvideo($idvideo)
    {
        DB::table('video')
            ->where('id', $idvideo)
            ->delete();
        return back();
    }
    public function deletedulieuhinhanh($idhinhanh)
    {
        DB::table('hinhanh')
            ->where('id', $idhinhanh)
            ->delete();
        return back();
    }
    public function doeditsanpham(Request $request)
    {
        $id = Auth::user()->id;
        request()->validate(
            [
                'anhsanpham' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            ],
            [
                'anhsanpham.image' => 'Hình ảnh phải có dạng jpg,jpeg,png',
                'anhsanpham.max' => 'Hình ảnh phải có độ phân giải dưới 5 mb',
            ]
        );
        $anhsanpham = $request->anhsanpham;
        if ($anhsanpham != null) {
            $anhsanpham = $anhsanpham->store('public/admin/' . $id);
            $linkanhsanpham = 'storage' . substr($anhsanpham, 6);
            $sanpham['anhsanpham'] = $linkanhsanpham;
        }
        if ($request->thongtinsanpham != null) $sanpham['thongtinsanpham'] = $request->thongtinsanpham;
        if ($request->xuatxusanpham != null) $sanpham['xuatxusanpham'] = $request->xuatxusanpham;
        if ($request->dongiasanpham != null) $sanpham['dongiasanpham'] = $request->dongiasanpham;
        if ($request->donvitinhsanpham != null) $sanpham['donvitinhsanpham'] = $request->donvitinhsanpham;
        $sanpham['hidden'] = $request->hidden;
        $sanpham['sanphamnoibat'] = $request->sanphamnoibat;
        DB::table('sanpham')
            ->where('id', $request->idsanpham)
            ->update($sanpham);

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

        $dulieuvideo = $request->dulieuvideo;
        $dulieuhinhanh = $request->dulieuhinhanh;
        if ($dulieuvideo != null) {
            $dulieuvideo = $dulieuvideo->store('public/admin/' . $id);
            $linkdulieuvideo = 'storage' . substr($dulieuvideo, 6);
            $video['idsanpham'] = $request->idsanpham;
            $video['dulieuvideo'] = $linkdulieuvideo;
            DB::table('video')
                ->where('idsanpham', $request->idsanpham)
                ->delete();
            DB::table('video')
                ->where('idsanpham', $request->idsanpham)
                ->insert($video);
        }
        if ($dulieuhinhanh != null) {
            $check = DB::table('hinhanh')
                ->where('idsanpham', $request->idsanpham)
                ->get();
            if (count($dulieuhinhanh) > 5 || (count($dulieuhinhanh) + count($check)) > 5) return back()->withErrors("Tối đa 5 ảnh cho sản phẩm");
            else {
                foreach ($dulieuhinhanh as $rowdulieuhinhanh) {
                    $imgsanpham = $rowdulieuhinhanh->store('public/admin/' . $id);
                    $linkimgsanpham = 'storage' . substr($imgsanpham, 6);
                    $hinhanh['idsanpham'] = $request->idsanpham;
                    $hinhanh['dulieuhinhanh'] = $linkimgsanpham;
                    DB::table('hinhanh')->insert($hinhanh);
                }
            }
        }

        $check = DB::table('sanpham')
            ->where('iddanhmuc', $request->iddanhmuc)
            ->where('tensanpham', $request->tensanpham)
            ->first();
        if ($check) {
            return back();
        } else {
            $sanpham['iddanhmuc'] = $request->iddanhmuc;
            $sanpham['tensanpham'] = $request->tensanpham;
            DB::table('sanpham')
                ->where('id', $request->idsanpham)
                ->update($sanpham);
            $khohang['tensanpham'] = $request->tensanpham;
            DB::table('khohang')
                ->where('idsanpham', $request->idsanpham)
                ->update($khohang);
            return back();
        }
    }
    public function deletesanpham(Request $request)
    {
        $id = Auth::user()->id;
        $idsanpham = $request->idsanpham;
        DB::table('chitietgiohang')
            ->where('idsanpham', $idsanpham)
            ->delete();
        DB::table('video')
            ->where('idsanpham', $idsanpham)
            ->delete();
        DB::table('hinhanh')
            ->where('idsanpham', $idsanpham)
            ->delete();
        DB::table('sanpham')
            ->where('id', $idsanpham)
            ->delete();
        return back();
    }
}
