<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
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
    ];

    public function getImageAttribute()
    {
        $image = $this->attributes['image'];
        $image_url = asset('admin/images/users/avatar-2.jpg');
        if (file_exists(public_path('uploads' . DIRECTORY_SEPARATOR . 'profile_images' . DIRECTORY_SEPARATOR . $image))) {
            $image_url = asset('uploads/profile_images/' . $image);
        }
        return $image_url;
    }

    public function role()
    {
        return $this->belongsTo(AdminRole::class, 'role_id');
    }
}
