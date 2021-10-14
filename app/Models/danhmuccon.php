<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class danhmuccon extends Model
{
    use HasFactory;
    protected $fillable = [
        'iddanhmuccha',
        'tendanhmuccon',
    ];
}
