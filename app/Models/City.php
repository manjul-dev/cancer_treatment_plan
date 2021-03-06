<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    /**
     * @return 
     */
    public static function getDistinctStaes()
    {
        return self::select('state')->distinct()->get();
    }

    public static function getAllCitiesForaState($state)
    {
        return self::where('state',$state)->select('city')->get();
    }
}
