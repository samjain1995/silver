<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AdminModulePermission extends Model
{
    use HasFactory;

    /* public function getImageAttribute()
    {
        $image_url = asset('images/no-image.png');
        $image = $this->attributes['image'];
        if (isset($image) && $image != '' && file_exists(public_path('uploads' . DIRECTORY_SEPARATOR . 'admin_module_permission_images' . DIRECTORY_SEPARATOR . $image))) {
            $image_url = asset('uploads/admin_module_permission_images/' . $image);
        }
        return $image_url;
    } */

    public function admin_permissions()
    {
        return $this->hasMany(AdminPermission::class, 'permission_id')
            ->where('role_id', Auth::user()->role_id);
    }
}
