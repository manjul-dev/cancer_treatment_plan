<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cancer extends Model
{
    use HasFactory;


    public static function getTypes()
    {
        return self::all()->pluck('type','id');
    }
}
