<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $modules = AdminModule::orderBy('name', 'ASC');
        if (!empty($request->name)) {
            $modules = $modules->where('name', 'LIKE', '%' . $request->name . '%');
        }
        $modules = $modules->paginate(50);
        return view('admin.modules.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.modules.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'icon' => ['required'],
            'image' => ['required'],
        ]);

        if ($validator->fails()) {
            $result = ['errors' => $validator->errors(), 'status' => 'validator_error'];
            return response($result, 200);
        }
        try {
            if (array_key_exists('module_id', $request->all()) && $request->module_id > 0) {
                $module = AdminModule::find($request->module_id);
                $message = 'Module Update Successfully';
            } else {
                $module = new AdminModule;
                $message = 'Module Created Successfully';
            }

            $module->name = $request->name;
            $module->icon = $request->icon;
            $module->view_sidebar = $request->view_sidebar ? 1 : 0;

            $file_path = 'admin_module_images' . DIRECTORY_SEPARATOR;
            if ($request->hasfile('image')) {
                if (!empty($module->image)) {
                    $this->RemoveFile($module->image, $file_path);
                }
                $module->image = $this->uploadFile($request->file('image'), $file_path);
            }

            if ($module->save()) {
                $result = ['message' => $message, 'status' => true];
                return response($result, 200);
            } else {
                $result = ['message' => "Something went Wrong", 'status' => false];
                return response($result, 200);
            }
        } catch (Exception $e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response($result, 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module = AdminModule::find($id);
        if ($module) {
            return view('admin.modules.edit', compact('module'));
        } else {
            $result = ['message' => "Module Data Not found..", 'status' => false];
            return response($result, 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $module = AdminModule::find($id);
            if ($module) {
                if (!empty($module->image)) {
                    $file_path = 'admin_module_images' . DIRECTORY_SEPARATOR;
                    $this->RemoveFile($module->image, $file_path);
                }
                if ($module->delete()) {
                    $result = ['message' => "Module Deleted Successfully", 'data' => [], 'status' => true];
                    return response($result, 200);
                } else {
                    $result = ['message' => "Something Went Wrong", 'data' => [], 'status' => false];
                    return response($result, 200);
                }
            } else {
                $result = ['message' => "Module Data Not Found...", 'data' => [], 'status' => false];
                return response($result, 200);
            }
        } catch (Exception $e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response($result, 200);
        }
    }
}
