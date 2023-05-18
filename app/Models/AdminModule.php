<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AdminModule extends Model
{
    use HasFactory;

    public function getImageAttribute()
    {
        $image = $this->attributes['image'];
        $image_url = asset('images/no-image.png');
        if (isset($image) && $image != '' && file_exists(public_path('uploads' . DIRECTORY_SEPARATOR . 'admin_module_images' . DIRECTORY_SEPARATOR . $image))) {
            $image_url = asset('uploads/admin_module_images/' . $image);
        }
        return $image_url;
    }

    public function permissions()
    {
        return $this->hasMany(AdminModulePermission::class, 'module_id');
    }

    public function admin_module_permissions()
    {
        return $this->hasMany(AdminPermission::class, 'module_id')
            ->where('role_id', Auth::user()->role_id);
    }

}
