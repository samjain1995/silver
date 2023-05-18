<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadFile($icon, $file_path)
    {
        $drive = public_path('uploads' . DIRECTORY_SEPARATOR . $file_path);
        $extension = $icon->getClientOriginalExtension();
        $filename = uniqid() . '.' . $extension;
        $newImage = $drive . $filename;
        $imgResource = $icon->move($drive, $filename);
        return $filename;
    }

    public function RemoveFile($image_url, $file_path)
    {
        $image = basename($image_url);
        $ImagePath = public_path('uploads' . DIRECTORY_SEPARATOR . $file_path . $image);
        if (\File::exists($ImagePath)) {
            \File::delete($ImagePath);
        }
    }
}