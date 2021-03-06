<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'state',
        'city',
        'address',
        'pin',
        'type',
        'attachment',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'attachment' => 'array',
    ];

    public static function saveAttachment($file,$key)
    {
        $destinationPath = "uploads/customerData/";
        $fileName = $file->getClientOriginalName().time().$key;
        $ext = $file->extension();
        $fileName = $fileName.'.'.$ext;
        $upload = $file->move($destinationPath, $fileName);
        if ($upload) {
            return $fileName;
        }
        return false;
    }

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
