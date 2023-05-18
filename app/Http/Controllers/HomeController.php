<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function uploadCkEditorImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file_path = 'ckeditor_images' . DIRECTORY_SEPARATOR;
            $fileName = $this->uploadFile($request->file('upload'), $file_path);
            $url = asset('uploads/ckeditor_images/' . $fileName);
            $msg = 'Image uploaded successfully';
            return "<script>window.parent.CKEDITOR.tools.callFunction('{$request->CKEditorFuncNum}','{$url}','{$msg}')</script>";
        }
    }
}
