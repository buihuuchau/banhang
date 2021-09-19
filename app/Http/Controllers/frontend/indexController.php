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
    public function index()
    {
        $thongtinshop = DB::table('thongtinshop')
            ->first();
        $danhmuc = DB::table('danhmuc')
            ->where('hidden', 0)
            ->get();
        $sanpham = DB::table('sanpham')
            ->join('danhmuc', 'sanpham.iddanhmuc', '=', 'danhmuc.id')
            ->orderBy('sanpham.id', 'desc')
            ->where('sanpham.hidden', 0)
            ->where('sanpham.sanphamnoibat', 1)
            ->select('sanpham.*', 'danhmuc.tendanhmuc')
            ->simplePaginate(15);
        return view('frontend.index', compact('thongtinshop', 'danhmuc', 'sanpham'));
    }
}
