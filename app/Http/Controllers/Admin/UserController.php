<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)
    {

        $users = User::with(['role'])->orderBy('name', 'ASC');

        if (!empty($request->name)) {

            $users = $users->where('name', 'LIKE', '%' . $request->name . '%');

        }

        if (!empty($request->role)) {

            $users = $users->where('role_id', $request->role);

        }

        $roles = AdminRole::orderBy('name', 'ASC')

            ->get();

        $users = $users->paginate(50);

        return view('admin.users.index', compact('users', 'roles'));

    }

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()
    {

        $roles = AdminRole::orderBy('name', 'ASC')

            ->get();

        return view('admin.users.add', compact('roles'));

    }

    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)
    {

        $validatedData = $request->validate([

            'first_name' => ['required'],

            //'last_name' => ['required'],

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

            'mobile' => ['required'],

            'gender' => ['required'],

            'role_id' => ['required'],

            'address' => ['required'],
            'password' => ['required'],

        ]);

        $user = new User;

        $user->role_id = $request->role_id;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mobile = $request->mobile;
        $user->gender = $request->gender;
        $user->address = $request->address;

        if ($user->save()) {

            return redirect()->route('admin.users.index')->with('success', 'User Added successfully');

        } else {

            return redirect()->back()->with('error', 'Something Went Wrong !');

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

        $user = User::find($id);

        $roles = AdminRole::orderBy('name', 'ASC')

            ->get();

        return view('admin.users.edit', compact('user', 'roles'));

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

        $validatedData = $request->validate([
            'first_name' => ['required'],
            //'last_name' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'mobile' => ['required'],
            'gender' => ['required'],
            'role_id' => ['required'],
            'address' => ['required'],
        ]);

        $user = User::find($id);
        $user->role_id = $request->role_id;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        
        $user->gender = $request->gender;
        $user->address = $request->address;

        if ($user->save()) {
            return redirect()->route('admin.users.index')->with('success', 'User Added successfully');
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong !');
        }

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

            $user = User::find($id);

            if ($user) {

                if ($user->delete()) {

                    $result = ['message' => "user Deleted Successfully", 'data' => [], 'status' => true];

                    return response($result, 200);

                } else {

                    $result = ['message' => "Something Went Wrong", 'data' => [], 'status' => false];

                    return response($result, 200);

                }

            } else {

                $result = ['message' => "user Data Not Found...", 'data' => [], 'status' => false];

                return response($result, 200);

            }

        } catch (Exception $e) {

            $result = ['message' => $e->getMessage(), 'status' => false];

            return response($result, 200);

        }

    }

}
