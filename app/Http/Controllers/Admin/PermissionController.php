<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminModule;
use App\Models\AdminModulePermission;
use App\Models\AdminRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $module = AdminModule::find($request->module_id);

        if (empty($module)) {
            return redirect()->back()->with('error', 'Module Data not Found');
        }

        $permissions = AdminModulePermission::where('module_id', $module->id)->orderBy('name', 'ASC');
        if (!empty($request->name)) {
            //$permissions = $permissions->where('name', 'LIKE', '%' . $request->name . '%');
        }

        $roles = AdminRole::orderBy('name', 'ASC')
            ->where('id', '!=', 1)
            ->get();

        $permissions = $permissions->paginate(50);
        // $aaa = \SiteHelper::get_admin_sidebar_tree();
        // print_r($aaa->toArray());
        // exit();
        return view('admin.permissions.index', compact('permissions', 'module', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissions.add');
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
            'permission_key' => ['required'],
            'url' => ['required'],
            'rank' => ['required'],
            'icon' => ['required'],
            'image' => ['required'],
        ]);

        if ($validator->fails()) {
            $result = ['errors' => $validator->errors(), 'status' => 'validator_error'];
            return response($result, 200);
        }

        try {

            if (array_key_exists('permission_id', $request->all()) && $request->permission_id > 0) {
                $permission = AdminModulePermission::find($request->permission_id);
                $message = 'Permissions Update Successfully';
            } else {
                $permission = new AdminModulePermission;
                $message = 'Permissions Created Successfully';
            }
            $permission->module_id = $request->module_id;
            $permission->name = $request->name;
            $permission->permission_key = $request->permission_key;
            $permission->url = $request->url;
            $permission->rank = $request->rank;
            $permission->icon = $request->icon;
            $permission->view_sidebar = $request->view_sidebar ? 1 : 0;

            $file_path = 'admin_module_permission_images' . DIRECTORY_SEPARATOR;
            if ($request->hasfile('image')) {
                if (!empty($permission->image)) {
                    $this->RemoveFile($permission->image, $file_path);
                }
                $permission->image = $this->uploadFile($request->file('image'), $file_path);
            }

            if ($permission->save()) {
                $result = ['message' => $message, 'status' => true];
                return response($result, 200);
            } else {
                $result = ['message' => "Something went Wrong", 'status' => false];
                return response($result, 200);
            }

        } catch (\Exception $e) {
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
        $permission = AdminModulePermission::find($id);
        if ($permission) {
            return view('admin.permissions.edit', compact('permission'));
        } else {
            $result = ['message' => "Permissions Data Not found..", 'status' => false];
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
            $module = AdminModulePermission::find($id);
            if ($module) {
                if (!empty($module->image)) {
                    $file_path = 'admin_module_images' . DIRECTORY_SEPARATOR;
                    $this->RemoveFile($module->image, $file_path);
                }
                if ($module->delete()) {
                    $result = ['message' => "Permissions Deleted Successfully", 'data' => [], 'status' => true];
                    return response($result, 200);
                } else {
                    $result = ['message' => "Something Went Wrong", 'data' => [], 'status' => false];
                    return response($result, 200);
                }
            } else {
                $result = ['message' => "Permissions Data Not Found...", 'data' => [], 'status' => false];
                return response($result, 200);
            }
        } catch (\Exception $e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response($result, 200);
        }
    }
}
