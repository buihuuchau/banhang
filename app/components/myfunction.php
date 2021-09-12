<?php

namespace App\components;

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

class myfunction
{
    private $htmlSelect = '';
    private $htmlSelect2 = '';
    public function __construct($danhmuc)
    {
        $this->danhmuc = $danhmuc;
    }
    function xemdanhmuc($danhmuccha = 0, $text = '')
    {
        foreach ($this->danhmuc as $rowdanhmuc) {
            if ($rowdanhmuc->danhmuccha == $danhmuccha && $danhmuccha == 0) {
                // echo "<option>" . $text . $rowdanhmuc->tendanhmuc . "<option>";
                $this->htmlSelect .= "<option value='$rowdanhmuc->id' style='color:red'>" . $text . $rowdanhmuc->tendanhmuc . "</option>";
                $this->xemdanhmuc($rowdanhmuc->id, $text . '&nbsp&nbsp&nbsp&nbsp&nbsp');
                // $this->xemdanhmuc($abc = $rowdanhmuc->id, $text . '__');
            } elseif ($rowdanhmuc->danhmuccha == $danhmuccha && $danhmuccha != 0) {
                // echo "<option>" . $text . $rowdanhmuc->tendanhmuc . "<option>";
                $this->htmlSelect .= "<option value='$rowdanhmuc->id'>" . $text . $rowdanhmuc->tendanhmuc . "</option>";
                $this->xemdanhmuc($rowdanhmuc->id, $text . '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp');
                // $this->xemdanhmuc($abc = $rowdanhmuc->id, $text . '__');
            }
        }
        return $this->htmlSelect;
    }
}
