<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use Barryvdh\DomPDF\Facade\Pdf;

class CustomerController extends Controller
{

    public function getMobileAutocompleteDate(Request $request)
    {
        $filter_field = "mobile";
        if ($request->filter == 'name') {
            $filter_field = "name";
        }
        $data = Customer::where($filter_field, "LIKE", "%{$request->input('query')}%")
            ->get();
        return response()->json($data);

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle' => ['required', 'max:250', 'string'],
            'sales_person' => ['required'],
            //'mobile' => ['required', 'max:250', 'string'],
            //'name' => ['required', 'max:250', 'string'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }
        try {

            $customer = new Customer;
            $customer->vehicle = $request->vehicle;
            $customer->mobile = $request->mobile;
            $customer->taxi_number = $request->taxi_number;
            $customer->name = $request->name;
            $customer->checkin_date_time = date('Y-m-d H:i:s');
            if ($request->couple) {
                $customer->couple = $request->couple;
            }

            if ($request->men) {
                $customer->men = $request->men;
            }

            if ($request->women) {
                $customer->women = $request->women;
            }

            if ($request->children) {
                $customer->children = $request->children;
            }

            if (!empty($request->sales_person)) {
                $customer->sales_person = $request->sales_person;

                if ($request->sales_person == 14) {
                    $customer->is_textile = 1;
                }
            }
            if ($customer->save()) {
                $result = ['message' => 'Customer Check In Successfully.', 'status' => true];
                return response()->json($result, 200);
            } else {
                $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
                return response()->json($result, 200);
            }
        } catch (\Throwable $e) {

            $result = ['message' => $e->getMessage(), 'status' => false];

            return response()->json($result, 200);

        }

    }

    public function customerByTexi(Request $request)
    {

        $customer = Customer::with(['user'])->where('is_checkout', 1)
            ->where('is_sell', 1)
            ->where('commission_amount', 0.00)
            ->where('taxi_number', $request->taxi_number)
        //->whereDate('checkin_date_time', date('Y-m-d'))
            ->first();
        if ($customer) {
            $result = ['message' => '', 'data' => $customer, 'status' => true];
            return response()->json($result, 200);
        } else {
            $result = ['message' => 'No Commission Due  in this Texi.', 'data' => [], 'status' => false];
            return response()->json($result, 200);
        }

    }

    public function getOtp(Request $request)
    {
        $otp = rand(100000, 999999); 
        Session::put('otp', $otp);
        $result = ['message' => 'Otp Send  Successfully', 'data' => $otp, 'status' => true];
        return response()->json($result, 200);
    }

    public function VarifyOtp(Request $request)
    {
        if (Session::has('otp') && !empty(Session::get('otp'))) {
            if (Session::get('otp') == $request->otp) {
                $customers = Customer::with(['user'])->where('is_checkout', 1)
                    ->where('is_sell', 1)
                    ->where('commission_amount', 0.00)
                    ->where('taxi_number', $request->taxi_number)
                    ->get();
                Session::forget('otp');
                if ($customers) {
                    $html = "" . view('staff.set-commission-table', compact('customers')) . "";
                    $result = ['message' => "", 'html' => $html, 'customers_count' => count($customers), 'status' => true];
                    return response()->json($result, 200);
                } else {
                    $result = ['message' => 'No Data  Found.', 'data' => [], 'status' => false];
                    return response()->json($result, 200);
                }
            } else {
                $result = ['message' => 'Your Otp is invalid .', 'data' => [], 'status' => false];
                return response()->json($result, 200);
            }
        } else {
            $result = ['message' => 'Your Otp is Expaired or invalid .', 'data' => [], 'status' => false];
            return response()->json($result, 200);
        }
    }

    public function updateCustomerCommission(Request $request)
    {
        $customers = $request->customers;
        if ($customers && count($customers) > 0 && is_array($customers)) {
            foreach ($customers as $key => $value) {
                $customer = Customer::find($value['id']);
                if ($value['commission']) {
                    $customer->commission_amount = $value['commission'];
                }
                $customer->save();
            }
            Session::flash('success', 'Commission Updated Successfully.');
            $result = ['message' => 'Commission Updated Successfully.', 'data' => [], 'status' => true];
            return response()->json($result, 200);
        } else {
            $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
            return response()->json($result, 200);
        }
    }

    public function monthlyReport(Request $request)
    {
        $checkin_date_time = date('Y-m-d');
        if (!empty($request->checkin_date_time)) {
            $checkin_date_time = $request->checkin_date_time;
        }

        $customers = Customer::select(
            \DB::raw('DATE(checkin_date_time) as date'),
            \DB::raw("(sum(cash_amount)) as total_cash_amount"),
            \DB::raw("(sum(upi_amount)) as total_upi_amount"),
            \DB::raw("(sum(card_amount)) as total_card_amount"),
            \DB::raw("(sum(amount)) as total_amount"),
            \DB::raw("(sum(commission_amount)) as total_commission_amount"),
            \DB::raw("(sum(pai)) as total_pai_amount")
        )->whereYear('checkin_date_time', date('Y', strtotime($checkin_date_time)))
            ->whereMonth('checkin_date_time', date('m', strtotime($checkin_date_time)));

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
            $customers = $customers->where('sales_person', $curr_sales_person->id);
        }

        if (!empty($request->taxi_number)) {
            $customers = $customers->where('taxi_number', 'LIKE', '%' . $request->taxi_number . '%');
        }

        $customers = $customers->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
        if (!empty($request->export_excel)) {
            return Excel::download(new \App\Exports\DalyReportExport ($customers), 'customers.xlsx');
        }

        if (!empty($request->export_pdf)) {
            $pdf = Pdf::loadView('pdf.salesman-monthly-report-pdf', ['customers'=>$customers]);
            return $pdf->stream();
        }
        $users = User::where('role_id', 2)->orderBy('name', 'ASC')->get();
        return view('staff.monthly-report', compact('customers', 'users', 'curr_sales_person'));
    }

    public function yearlyReport(Request $request)
    {
        $currentMonth = date('n');
        $currentYear = date('Y');

        $start_date = '';
        $end_date = '';
        $years = [];
        if ($currentMonth >= 4) {
            $financialYear = $currentYear . '-' . ($currentYear + 1);

            $next_year = $currentYear + 1;
            $start_date = date('01-04-' . $currentYear);
            $end_date = date('31-03-' . $next_year);
            $years = [$currentYear, $next_year];
        } else {
            $financialYear = ($currentYear - 1) . '-' . $currentYear;
        }

        if (!empty($request->checkin_date_time)) {
            $checkin_date_time = explode('-', $request->checkin_date_time);
            $years = $checkin_date_time;
            $start_date = date('01-04-' . $checkin_date_time[0]);
            $end_date = date('31-03-' . $checkin_date_time[1]);
        }
        $customers = Customer::whereDate('checkin_date_time', '>=', $start_date);

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
            $customers = $customers->where('sales_person', $curr_sales_person->id);
        }

        if (!empty($request->taxi_number)) {
            $customers = $customers->where('taxi_number', 'LIKE', '%' . $request->taxi_number . '%');
        }

        $customers = $customers->select(
            \DB::raw('YEAR(checkin_date_time) as year'),
            \DB::raw('MONTH(checkin_date_time) as month'),
            \DB::raw("(sum(cash_amount)) as total_cash_amount"),
            \DB::raw("(sum(upi_amount)) as total_upi_amount"),
            \DB::raw("(sum(card_amount)) as total_card_amount"),
            \DB::raw("(sum(amount)) as total_amount"),
            \DB::raw("(sum(commission_amount)) as total_commission_amount"),
            \DB::raw("(sum(pai)) as s")
        )
            ->groupBy('year', 'month')
            ->limit(12)
            ->get();
        if (!empty($request->export_excel)) {
            return Excel::download(new \App\Exports\DalyReportExport ($customers), 'customers.xlsx');
        }

        if (!empty($request->export_pdf)) {
            $pdf = Pdf::loadView('pdf.salesman-yearly-report-pdf', ['customers'=>$customers]);
            return $pdf->stream();
        }
        $users = User::where('role_id', 2)->orderBy('name', 'ASC')->get();
        return view('staff.yearly-report', compact('customers', 'users', 'curr_sales_person'));
    }

    public function salesPersonMonthlyReport(Request $request)
    {
        $customers = Customer::with(['user'])->orderBy('id', 'DESC');
        if (!empty($request->sales_person)) {
            $customers = $customers->where('sales_person', $request->sales_person);
        }

        if (!empty($request->month)) {
            $customers = $customers->whereMonth('checkin_date_time', $request->month);
        }

        if (!empty($request->year)) {
            $customers = $customers->whereYear('checkin_date_time', $request->year);
        }
        $customers = $customers->get();

        return view('staff.sales-person-monthly-report', compact('customers'));
    }
}
