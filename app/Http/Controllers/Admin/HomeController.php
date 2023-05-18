<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::with(['user'])
            ->orderBy('id', 'DESC')
            ->where('is_checkout', 0)
            ->whereDate('checkin_date_time', date('Y-m-d'));
        $customers = $customers->get();
        if ($request->ajax()) {
            $total_customers = Customer::count();
            $today_customers = Customer::whereDate('checkin_date_time', date('Y-m-d'))->count();
            $today_sale = Customer::whereDate('checkin_date_time', date('Y-m-d'))->sum('amount');
            $today_cash_amount = Customer::whereDate('checkin_date_time', date('Y-m-d'))->sum('cash_amount');
            $today_upi_amount = Customer::whereDate('checkin_date_time', date('Y-m-d'))->sum('upi_amount');
            $today_card_amount = Customer::whereDate('checkin_date_time', date('Y-m-d'))->sum('card_amount');
            $total_sale = Customer::sum('amount');
            $html = '' . view('admin.customers.table-data', compact('customers')) . '';

            $result['html'] = $html;
            $result['total_customers'] = $total_customers;
            $result['today_customers'] = $today_customers;
            $result['today_sale'] = $today_sale;
            $result['today_cash_amount'] = $today_cash_amount;
            $result['today_upi_amount'] = $today_upi_amount;
            $result['today_card_amount'] = $today_card_amount;
            $result['total_sale'] = $total_sale;
            return $result;
        } else {
            return view('admin.dashboard');
        }

    }

    public function tvScreen(Request $request)
    {
        $customers = Customer::with(['user'])
            ->orderBy('id', 'DESC')
            ->where('is_checkout', 0)
            ->whereDate('checkin_date_time', date('Y-m-d'));

        $customers = $customers->get();

        if ($request->ajax()) {
            $html = '' . view('admin.tv-screen-table-data', compact('customers')) . '';
            $result['html'] = $html;
            return $result;
        } else {
            return view('admin.tv-screen');
        }
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required',
            'gender' => 'required',
        ]);

        try {

            $user = Admin::findOrFail(Auth::user()->id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->mobile = $request->mobile;
            $user->gender = $request->gender;

            if ($request->hasfile('image')) {
                $file_path = 'profile_images' . DIRECTORY_SEPARATOR;
                $user->image = $this->uploadFile($request->file('image'), $file_path);
            }
            if ($user->save()) {
                return redirect()->route('admin.dashboard')->with('success', 'Password Change Successfully.');
            } else {
                return redirect()->route('admin.dashboard')
                    ->with('error', 'Oops..something has went wrong. Please try again.');
            }
        } catch (\Throwable$e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function change_password()
    {
        return view('admin.change-password');
    }

    public function update_password(Request $request)
    {
        $validatedData = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);

        $user = Admin::findOrFail(Auth::user()->id);
        if ($request->old_password) {
            if (Hash::check($request->old_password, $user->password)) {
                if ($request->new_password == $request->confirm_password) {
                    $input['password'] = Hash::make($request->new_password);
                    $user->update($input);
                    return redirect()->route('admin.change-password')->with('success', 'Password Change Successfully.');
                } else {
                    return redirect()->route('admin.change-password')->with('error', 'Confirm Password Doesnot Match');
                }
            } else {
                return redirect()->route('admin.change-password')->with('error', 'Old Password Does not match');
            }
        }
    }
}
