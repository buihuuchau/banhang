<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use App\Models\danhmuccha;
use App\Models\danhmuccon;
use App\Models\test;
use Illuminate\Http\Request;

class testController extends Controller
{
    public function test()
    {
        $danhmuccha = danhmuccha::all();
        $danhmuccon = danhmuccon::all();
        return view('test.test', compact('danhmuccha', 'danhmuccon'));
    }
    public function testdangky(Request $request)
    {
        $test = test::create([
            'sdt' => $request->sdt,
            'name' => $request->name,
            'sex' => $request->sex,
            'ngaysinh' => $request->ngaysinh,
        ]);
        return back();
    }
    public function danhmuccon($iddanhmuccha)
    {
        $danhmuccon = danhmuccon::where('iddanhmuccha', $iddanhmuccha)->get();
        foreach ($danhmuccon as $rowdanhmuccon) {
            echo "<option value='" .   $rowdanhmuccon->id  . "'>" .  $rowdanhmuccon->tendanhmuccon   . "</option>";
        }
    }
}
