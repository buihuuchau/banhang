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
    // public function capnhatthongtinshop()
    // {
    //     $id = Auth::user()->id;
    //     $thongtinshop = DB::table('thongtinshop')
    //         ->where('idusers', $id)
    //         ->first();
    //     return view('admin.shop.capnhatthongtinshop', compact('thongtinshop'));
    // }
    public function capnhatthongtinshop(Request $request)
    {
        $id = Auth::user()->id;
        if ($request->hasFile('logoshop')) {
            $logoshop = $request->file('logoshop')->store('public/admin/' . $id);
            $linklogoshop = 'storage' . substr($logoshop, 6);
        }

        request()->validate(
            [
                'logoshop' => 'image|mimes:jpeg,png,jpg|max:4096',
            ],
            [
                'logoshop.image' => 'Hình ảnh phải có dạng jpg,jpeg,png',
                'logoshop.max' => 'Hình ảnh phải có độ phân giải dưới 4 mb',
            ]
        );

        $thongtinshop['id'] = $id;
        $thongtinshop['tenshop'] = $request->tenshop;
        $thongtinshop['logoshop'] = $linklogoshop;
        $thongtinshop['diachishop'] = $request->diachishop;
        $thongtinshop['dienthoaishop'] = $request->dienthoaishop;
        $thongtinshop['emailshop'] = $request->emailshop;
        $thongtinshop['websiteshop'] = $request->websiteshop;
        $thongtinshop['vitrishop'] = $request->vitrishop;
        DB::table('thongtinshop')->insert($thongtinshop);
        return redirect('firstpage')->withErrors('Không thể thực hiện được');
    }
    public function suathongtinshop(Request $request)
    {
        $id = Auth::user()->id;
        if ($request->hasFile('logoshop')) {
            $logoshop = $request->file('logoshop')->store('public/admin/' . $id);
            $linklogoshop = 'storage' . substr($logoshop, 6);
            $thongtinshop['logoshop'] = $linklogoshop;
        }

        request()->validate(
            [
                'logoshop' => 'image|mimes:jpeg,png,jpg|max:4096',
            ],
            [
                'logoshop.image' => 'Hình ảnh phải có dạng jpg,jpeg,png',
                'logoshop.max' => 'Hình ảnh phải có độ phân giải dưới 4 mb',
            ]
        );

        $thongtinshop['tenshop'] = $request->tenshop;
        $thongtinshop['diachishop'] = $request->diachishop;
        $thongtinshop['dienthoaishop'] = $request->dienthoaishop;
        $thongtinshop['emailshop'] = $request->emailshop;
        $thongtinshop['websiteshop'] = $request->websiteshop;
        $thongtinshop['vitrishop'] = $request->vitrishop;
        DB::table('thongtinshop')
            ->where('id', $id)
            ->update($thongtinshop);
        return redirect('firstpage')->withErrors('Không thể thực hiện được');
    }
}
