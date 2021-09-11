<?php

namespace App\Http\Controllers\admin\danhmuc;

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

class quanlydanhmucController extends Controller
{
    // private $htmlSelect = '';
    // private $htmlSelect;
    // public function __construct()
    // {
    //     $this->htmlSelect = '';
    //     // $this->danhmuc = $danhmuc;
    //     // $this->thongtinshop = $thongtinshop;
    // }
    // function xemdanhmuc($danhmuccha = 0, $text = '')
    // {
    //     $id = Auth::user()->id;
    //     $danhmuc = DB::table('danhmuc')
    //         ->where('idusers', $id)
    //         ->get();
    //     foreach ($danhmuc as $rowdanhmuc) {
    //         if ($rowdanhmuc->danhmuccha == $danhmuccha) {
    //             // echo "<option>" . $text . $rowdanhmuc->tendanhmuc . "<option>";
    //             $this->htmlSelect .= "<option value='$rowdanhmuc->id'>" . $text . $rowdanhmuc->tendanhmuc . "</option>";
    //             $this->xemdanhmuc($rowdanhmuc->id, $text . '__');
    //         }
    //     }
    //     return $this->htmlSelect;
    // }
    public function quanlydanhmuc()
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
        // $htmlOption = $this->xemdanhmuc(0);
        $callfunction = new myfunction($danhmuc, $thongtinshop);
        $htmlOption = $callfunction->xemdanhmuc();
        return view('admin.danhmuc.quanlydanhmuc', compact('thongtinshop', 'sudung', 'danhmuc', 'sanpham', 'htmlOption'));
    }
    public function adddanhmuc(Request $request)
    {
        $id = Auth::user()->id;
        $check = DB::table('danhmuc')
            ->where('idusers', $id)
            ->where('danhmuccha', $request->danhmuccha)
            ->where('tendanhmuc', $request->tendanhmuc)
            ->first();
        if ($check) return back()->withErrors('Tên danh mục bị trùng');
        else {
            $danhmuc['idusers'] = $id;
            $danhmuc['tendanhmuc'] = $request->tendanhmuc;
            $danhmuc['danhmuccha'] = $request->danhmuccha;
            DB::table('danhmuc')->insert($danhmuc);
            return back();
        }
    }
}
