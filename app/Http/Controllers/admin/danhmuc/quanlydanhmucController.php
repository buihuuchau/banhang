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
    public function quanlydanhmuc(Request $request)
    {
        $id = Auth::user()->id;
        $thongtinshop = DB::table('thongtinshop')
            ->where('id', $id)
            ->first();
        $sudung = null;
        $danhmuc = DB::table('danhmuc')
            ->get();
        $danhmuc2 = DB::table('danhmuc')
            ->where('hidden', 0)
            ->get();
        $sanpham = DB::table('sanpham')
            ->get();
        // $htmlOption = $this->xemdanhmuc(0);
        $callfunction = new myfunction($danhmuc2);
        $htmlOption = $callfunction->xemdanhmuc2();

        if ($request->ajax() && $request->iddanhmuc) {
            $check = DB::table('danhmuc')->where('id', $request->iddanhmuc)->first();
            if ($check) {
                $danhmuc3['hidden'] = !$check->hidden;
                DB::table('danhmuc')->where('id', $request->iddanhmuc)->update($danhmuc3);
            }
            return "
                <script>
                    alert('chuyen doi thanh cong');
                </script>
            ";
        }

        return view('admin.danhmuc.quanlydanhmuc', compact('thongtinshop', 'sudung', 'danhmuc', 'sanpham', 'htmlOption'));
    }
    public function adddanhmuc(Request $request)
    {
        $id = Auth::user()->id;
        $check = DB::table('danhmuc')
            ->where('danhmuccha', $request->danhmuccha)
            ->where('tendanhmuc', $request->tendanhmuc)
            ->first();
        if ($check) return back()->withErrors('Tên danh mục bị trùng');
        else {
            $danhmuc['tendanhmuc'] = $request->tendanhmuc;
            $danhmuc['danhmuccha'] = $request->danhmuccha;
            DB::table('danhmuc')->insert($danhmuc);
            return back();
        }
    }
    public function editdanhmuc(Request $request)
    {
        $id = Auth::user()->id;
        $check = DB::table('danhmuc')
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
