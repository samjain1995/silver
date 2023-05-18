<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function showGeneralSettingsForm()
    {
        $settings = Setting::where('id', '1')->first();
        return view('admin.settings.general-settings',compact('settings'));
    }

    public function saveGeneralSettings(Request $request)
    {
        {
            $inputs = $request->only(["company_name", "company_email", "contect_number", "company_address", "company_logo", "company_favicon", "facebook", "twitter", "youtube", "linkedin", "instagram", "pinterest", "googleplus", "skype", "yahoo", "date_format", "date_time_format"]);

            $setting = Setting::find(1);
            $file_path = 'logo_images' . DIRECTORY_SEPARATOR;
            if ($request->hasfile('company_logo')) {
                $inputs['company_logo'] = $this->uploadFile($request->file('company_logo'), $file_path);
            }
            if ($request->hasfile('company_favicon')) {
                $inputs['company_favicon'] = $this->uploadFile($request->file('company_favicon'), $file_path);
            }
            if ($setting) {
                if ($request->hasfile('company_logo')) {
                    $this->RemoveFile($setting->company_logo, $file_path);
                }
                if ($request->hasfile('company_favicon')) {
                    $this->RemoveFile($setting->company_favicon, $file_path);
                }
                $setting->update($inputs);
                return redirect()->route('admin.settings.general-settings')->with('success', 'Update Successfull.');
            } elseif (Setting::create($inputs)) {
                return redirect()->route('admin.settings.general-settings')->with('success', 'Insert Successfull.');
            } else {
                return redirect()->route('admin.settings.general-settings')->with('error', 'Something Went Wrong !');
            }
        }
    }
}
