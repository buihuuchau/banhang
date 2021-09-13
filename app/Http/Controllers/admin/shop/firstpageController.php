<?php

namespace App\Http\Controllers\admin\shop;

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

class firstpageController extends Controller
{
    public function thongtinshop()
    {
        $id = Auth::user()->id;
        $thongtinshop = DB::table('thongtinshop')
            ->where('id', $id)
            ->first();
        return view('admin.shop.firstpage', compact('thongtinshop'));
    }
    public function capnhatthongtinshop(Request $request)
    {
        $id = Auth::user()->id;

        $logoshop = $request->logoshop;
        request()->validate(
            [
                'logoshop' => 'image|mimes:jpeg,png,jpg|max:4096',
            ],
            [
                'logoshop.image' => 'Hình ảnh phải có dạng jpg,jpeg,png',
                'logoshop.max' => 'Hình ảnh phải có độ phân giải dưới 4 mb',
            ]
        );
        if ($logoshop != null) {
            $logoshop = $logoshop->store('public/admin/' . $id);
            $linklogoshop = 'storage' . substr($logoshop, 6);
        }

        $thongtinshop['id'] = $id;
        $thongtinshop['tenshop'] = $request->tenshop;
        $thongtinshop['logoshop'] = $linklogoshop;
        $thongtinshop['diachishop'] = $request->diachishop;
        $thongtinshop['dienthoaishop'] = $request->dienthoaishop;
        $thongtinshop['emailshop'] = $request->emailshop;
        $thongtinshop['websiteshop'] = $request->websiteshop;
        $thongtinshop['vitrishop'] = $request->vitrishop;
        DB::table('thongtinshop')->insert($thongtinshop);
        return back();
    }
    public function suathongtinshop(Request $request)
    {
        $id = Auth::user()->id;

        $logoshop = $request->logoshop;
        request()->validate(
            [
                'logoshop' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            ],
            [
                'logoshop.image' => 'Hình ảnh phải có dạng jpg,jpeg,png',
                'logoshop.max' => 'Hình ảnh phải có độ phân giải dưới 5 mb',
            ]
        );
        if ($logoshop != null) {
            $logoshop = $logoshop->store('public/admin/' . $id);
            $linklogoshop = 'storage' . substr($logoshop, 6);
            $thongtinshop['logoshop'] = $linklogoshop;
        }

        $thongtinshop['tenshop'] = $request->tenshop;
        $thongtinshop['diachishop'] = $request->diachishop;
        $thongtinshop['dienthoaishop'] = $request->dienthoaishop;
        $thongtinshop['emailshop'] = $request->emailshop;
        $thongtinshop['websiteshop'] = $request->websiteshop;
        $thongtinshop['vitrishop'] = $request->vitrishop;
        DB::table('thongtinshop')
            ->where('id', $id)
            ->update($thongtinshop);
        return back();
    }
}
