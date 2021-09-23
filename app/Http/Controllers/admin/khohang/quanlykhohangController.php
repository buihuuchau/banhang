<?php

namespace App\Http\Controllers\admin\khohang;

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

class quanlykhohangController extends Controller
{
    public function quanlykhohang()
    {
        $id = Auth::user()->id;
        $thongtinshop = DB::table('thongtinshop')
            ->where('id', $id)
            ->first();
        $khohang = DB::table('khohang')
            ->get();
        return view('admin.khohang.quanlykhohang', compact('thongtinshop', 'khohang'));
    }
}
