<?php

namespace App\Http\Controllers\admin\linhvuc;

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

class quanlylinhvucController extends Controller
{
    public function quanlylinhvuc()
    {
        $id = Auth::user()->id;
        $thongtinshop = DB::table('thongtinshop')
            ->where('id', $id)
            ->first();
        $sudung = null;
        $linhvuc = DB::table('linhvuc')
            ->where('idusers', $id)
            ->get();
        $sanpham = DB::table('sanpham')
            ->where('idusers', $id)
            ->get();
        return view('admin.linhvuc.quanlylinhvuc', compact('thongtinshop', 'sudung', 'linhvuc', 'sanpham'));
    }
    public function addlinhvuc(Request $request)
    {
        $id = Auth::user()->id;
        $check = DB::table('linhvuc')
            ->where('idusers', $id)
            ->where('tenlinhvuc', $request->tenlinhvuc)
            ->first();
        if ($check) return back()->withErrors('Tên lĩnh vực bị trùng');
        else {
            $linhvuc['idusers'] = $id;
            $linhvuc['tenlinhvuc'] = $request->tenlinhvuc;
            DB::table('linhvuc')->insert($linhvuc);
        }
        return back();
    }
    public function editlinhvuc(Request $request)
    {
        $id = Auth::user()->id;
        $check = DB::table('linhvuc')
            ->where('idusers', $id)
            ->where('tenlinhvuc', $request->tenlinhvuc)
            ->first();
        if ($check) return back()->withErrors('Tên lĩnh vực bị trùng');
        else {
            $linhvuc['tenlinhvuc'] = $request->tenlinhvuc;
            DB::table('linhvuc')
                ->where('id', $id)
                ->update($linhvuc);
        }
        return back();
    }
    public function hiddenlinhvuc($idlinhvuc)
    {
        $id = Auth::user()->id;
        $linhvuc['hidden'] = 1;
        DB::table('linhvuc')
            ->where('id', $idlinhvuc)
            ->where('idusers', $id)
            ->update($linhvuc);
        return back();
    }
    public function showlinhvuc($idlinhvuc)
    {
        $id = Auth::user()->id;
        $linhvuc['hidden'] = 0;
        DB::table('linhvuc')
            ->where('id', $idlinhvuc)
            ->where('idusers', $id)
            ->update($linhvuc);
        return back();
    }
    public function deletelinhvuc($idlinhvuc)
    {
        $id = Auth::user()->id;
        DB::table('linhvuc')
            ->where('id', $idlinhvuc)
            ->where('idusers', $id)
            ->delete();
        return back();
    }
}
