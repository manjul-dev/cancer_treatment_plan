<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;

class Doctor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }
    
    protected $fillable = [
        'name',
        'email',
        'specialist',
        'password',
    ];
}
