<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $email_templates = EmailTemplate::orderBy('name', 'ASC');
        if (!empty($request->name)) {
            $email_templates = $email_templates->where('name', 'LIKE', '%' . $request->name . '%');
        }
        $email_templates = $email_templates->paginate(50);
        return view('admin.settings.email-templates.index', compact('email_templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.email-templates.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $email_template = new EmailTemplate;
        $email_template->name = $request->name;
        $email_template->action = $request->action;
        $email_template->subject = $request->subject;
        $email_template->body = $request->body;
        if ($email_template->save()) {
            return redirect()->route('admin.settings.email-templates.index')->with('success', 'Email Template Added successfully');
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
        $email_template = EmailTemplate::find($id);
        return view('admin.settings.email-templates.edit', compact('email_template'));
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
        $email_template = EmailTemplate::find($id);
        $email_template->nane = $request->name;
        $email_template->action = $request->action;
        $email_template->subject = $request->subject;
        $email_template->body = $request->body;
        if ($email_template->save()) {
            return redirect()->route('admin.settings.email-templates.index')->with('success', 'Email Template Update successfully');
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
            $email_template = EmailTemplate::find($id);
            if ($email_template) {
                if ($email_template->delete()) {
                    $result = ['message' => "Email Template Deleted Successfully", 'data' => [], 'status' => true];
                    return response($result, 200);
                } else {
                    $result = ['message' => "Something Went Wrong", 'data' => [], 'status' => false];
                    return response($result, 200);
                }
            } else {
                $result = ['message' => "Email Template Data Not Found...", 'data' => [], 'status' => false];
                return response($result, 200);
            }
        } catch (Exception $e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response($result, 200);
        }
    }
}
