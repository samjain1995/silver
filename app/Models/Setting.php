<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ["company_name", "company_email", "contect_number", "company_address", "company_logo", "company_favicon", "facebook", "twitter", "youtube", "linkedin", "instagram", "pinterest", "googleplus", "skype", "yahoo", "date_format", "date_time_format"];

    public function getCompanyLogoAttribute()
    {
        $image = $this->attributes['company_logo'];
        $image_url = asset('images/logo/logo1.png');
        if (isset($image) && $image != '' && file_exists(public_path('uploads' . DIRECTORY_SEPARATOR . 'logo_images' . DIRECTORY_SEPARATOR . $image))) {
            $image_url = asset('uploads/logo_images/' . $image);
        }
        return $image_url;
    }

    public function getCompanyFaviconAttribute()
    {
        $image = $this->attributes['company_favicon'];
        $image_url = asset('images/logo/logo2.png');
        if (isset($image) && $image != '' && file_exists(public_path('uploads' . DIRECTORY_SEPARATOR . 'logo_images' . DIRECTORY_SEPARATOR . $image))) {
            $image_url = asset('uploads/logo_images/' . $image);
        }
        return $image_url;
    }
}
