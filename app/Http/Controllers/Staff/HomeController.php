<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class HomeController extends Controller
{

    public function securityGuard(Request $request)
    {

        $salesmans = User::where('role_id', 2)
            ->orderBy('id', 'DESC')
            ->get();
        return view('staff.security-guard', compact('salesmans'));

    }

    public function salesmanLeadList(Request $request)
    {

        $customers = Customer::where('is_checkout', 0)
        //->where('sales_person', \Auth::user()->id)
            ->whereDate('checkin_date_time', date('Y-m-d'))
            ->orderBy('id', 'DESC')
            ->get();

        return view('staff.salesman-lead-list', compact('customers'));

    }

    public function salesmanCustomer($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            if ($customer->is_checkout == 1) {
                return redirect()->back()->with('error', 'Amount  Already  Entered.');
            } else {
                $salesmans = User::where('role_id', 2)->get();
                return view('staff.salesman-lead', compact('customer', 'salesmans'));
            }

        } else {
            return redirect()->back()->with('error', 'customer data  not  found');
        }
    }

    public function salesmanCustomerUpdate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'customer_id' => ['required', 'max:250', 'string'],
            // 'bill_number' => ['required', 'max:250', 'string'],
            // 'amount' => ['required', 'max:250', 'string'],
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }
        try {

            $customer = Customer::find($request->customer_id);
            if ($customer) {
                $message = "Customer Updated Successfully.";

                if (!empty($request->name)) {
                    $customer->name = $request->name ? $request->name : "";
                }

                if (!empty($request->mobile)) {
                    $customer->mobile = $request->mobile ? $request->mobile : "";
                }

                if (!empty($request->cash_amount)) {
                    $customer->cash_amount = $request->cash_amount ? $request->cash_amount : 0.00;
                }

                if (!empty($request->bill_number)) {
                    $message = "Bill Created Successfully.";
                    $customer->bill_number = $request->bill_number;
                }
                if (!empty($request->cash_amount)) {
                    $customer->cash_amount = $request->cash_amount ? $request->cash_amount : 0.00;
                }
                if (!empty($request->upi_amount)) {
                    $customer->upi_amount = $request->upi_amount ? $request->upi_amount : 0.00;
                }
                if (!empty($request->card_amount)) {
                    $customer->card_amount = $request->card_amount ? $request->card_amount : 0.00;
                }
                if (!empty($request->amount)) {
                    $customer->amount = $request->amount ? $request->amount : 0.00;
                }

                if (!empty($request->sales_person)) {
                    $customer->sales_person = $request->sales_person ? $request->sales_person : $customer->sales_person;
                }

                if (!empty($request->commission)) {
                    $customer->commission = $request->commission ? $request->commission : 0.00;
                    $customer->description = $request->description;
                    $customer->checkout_date_time = date('Y-m-d H:i:s');
                    $customer->is_checkout = 1;
                    $customer->is_sell = 1;
                    $commission_amount = $request->amount * $request->commission / 100;
                    $customer->commission_amount = $commission_amount;

                    $customer->pai = $request->pai;
                }
                if ($customer->save()) {
                    \Session::flash('success', $message);
                    $result = ['message' => $message, 'status' => true];
                    return response()->json($result, 200);
                } else {
                    $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
                    return response()->json($result, 200);
                }
            } else {
                $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
                return response()->json($result, 200);
            }
        } catch (\Throwable $e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response()->json($result, 200);
        }
    }

    public function noSellUpdate(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'customer_id' => ['required', 'max:250', 'string'],

        ]);

        if ($validator->fails()) {

            $errors = $validator->errors();

            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];

            return response()->json($result, 200);

        }

        try {

            $customer = Customer::find($request->customer_id);

            if ($customer) {

                $customer->is_checkout = 1;

                $customer->is_sell = 0;

                $customer->checkout_date_time = date('Y-m-d H:i:s');

                if ($customer->save()) {

                    \Session::flash('success', 'Bill Created Successfully.');

                    $result = ['message' => 'Bill Created Successfully.', 'status' => true];

                    return response()->json($result, 200);

                } else {

                    $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];

                    return response()->json($result, 200);

                }

            } else {

                $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];

                return response()->json($result, 200);

            }

        } catch (\Throwable $e) {

            $result = ['message' => $e->getMessage(), 'status' => false];

            return response()->json($result, 200);

        }

    }

    public function cashier(Request $request)
    {
        $customers = Customer::where('is_checkout', 1)
            ->where('is_sell', 1)
        //->whereDate('checkin_date_time', date('Y-m-d'))
            ->get();
        return view('staff.cashier', compact('customers'));
    }

    public function cashierLeadList(Request $request)
    {
        $checkin_date_time = date('Y-m-d');
        if (!empty($request->checkin_date_time)) {
            $checkin_date_time = $request->checkin_date_time;
        }
        $customers = Customer::where('is_checkout', 1)
            ->orderBy('id', 'DESC')
        //->where('is_sell', 1)
            ->whereDate('checkin_date_time', $checkin_date_time)
            ->where('commission_amount', 0)
            ->get();

        return view('staff.cashier-lead-list', compact('customers'));
    }

    public function cashierCustomer($id)
    {

        $customer = Customer::find($id);

        if ($customer) {

            return view('staff.cashier-lead', compact('customer'));

        } else {

            return redirect()->back()->with('error', 'customer data  not  found');

        }

    }

    public function cashierCustomerUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => ['required', 'max:250', 'string'],
            'commission_amount' => ['required', 'max:250', 'string'],
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }
        try {

            $customer = Customer::find($request->customer_id);
            if ($customer) {
                $customer->commission_amount = $request->commission_amount ? $request->commission_amount : 0.00;
                if ($customer->save()) {
                    \Session::flash('success', 'Commission Created Successfully.');
                    $result = ['message' => 'Commission Created Successfully.', 'status' => true];
                    return response()->json($result, 200);
                } else {
                    $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
                    return response()->json($result, 200);
                }
            } else {
                $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
                return response()->json($result, 200);
            }
        } catch (\Throwable $e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response()->json($result, 200);
        }

    }

    public function securityGuardDalyReport(Request $request)
    {
        $checkin_date_time = date('Y-m-d');
        if (!empty($request->checkin_date_time)) {
            $checkin_date_time = $request->checkin_date_time;
        }
        $customers = Customer::with(['user'])
            ->orderBy('id', 'DESC')
            ->whereDate('checkin_date_time', $checkin_date_time)
            ->get();
        return view('staff.security-guard-daly-report', compact('customers'));
    }

    public function salesmanLeadReport(Request $request)
    {
        $checkin_date_time = date('Y-m-d');
        if (!empty($request->checkin_date_time)) {
            $checkin_date_time = $request->checkin_date_time;
        }
        $customers = Customer::with(['user'])
                    ->orderBy('id', 'DESC')
                    ->whereDate('checkin_date_time', $checkin_date_time);
        
        if (!empty($request->vehicle)) {
            $customers = $customers->where('vehicle', 'LIKE', '%' . $request->vehicle . '%');
        }

        if (!empty($request->mobile)) {
            $customers = $customers->where('mobile', 'LIKE', '%' . $request->mobile . '%');
        }

        $curr_sales_person = User::where('role_id', 2)->orderBy('name', 'ASC')->first();

        if (!empty($request->sales_person)) {
            $customers = $customers->where('sales_person', $request->sales_person);
        } else {
            // $customers = $customers->where('sales_person', $curr_sales_person->id);
        }

        if (!empty($request->taxi_number)) {
            $customers = $customers->where('taxi_number', 'LIKE', '%' . $request->taxi_number . '%');
        }
        //->where('is_checkout', 1)
        $customers = $customers->get();  

        if (!empty($request->export_pdf)) {
            $pdf = Pdf::loadView('pdf.salesman-daly-report-pdf', ['customers'=>$customers]);
            return $pdf->stream();
        }
        
        $users = User::where('role_id', 2)->orderBy('name', 'ASC')->get();
        return view('staff.salesman-lead-report', compact('customers','users','curr_sales_person'));
    }

}
