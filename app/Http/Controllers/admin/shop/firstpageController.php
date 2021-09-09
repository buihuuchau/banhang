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
        return view('admin.shop.firstpage');
    }
    public function capnhatthongtinshop()
    {
        return view('admin.shop.capnhatthongtinshop');
    }
}
