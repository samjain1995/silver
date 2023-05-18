<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::with(['user'])->orderBy('checkin_date_time', 'DESC');

        if (!empty($request->name)) {
            $customers = $customers->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if (!empty($request->vehicle)) {
            $customers = $customers->where('vehicle', 'LIKE', '%' . $request->vehicle . '%');
        }

        if (!empty($request->mobile)) {
            $customers = $customers->where('mobile', 'LIKE', '%' . $request->mobile . '%');
        }

        if (!empty($request->sales_person)) {
            $customers = $customers->where('sales_person', $request->sales_person);
        }

        if (!empty($request->taxi_number)) {
            $customers = $customers->where('taxi_number', 'LIKE', '%' . $request->taxi_number . '%');
        }

        if (!empty($request->bill_number)) {
            $customers = $customers->where('bill_number', 'LIKE', '%' . $request->bill_number . '%');
        }

        if (!empty($request->amount)) {
            $customers = $customers->where('amount', 'LIKE', '%' . $request->amount . '%');
        }

        if (!empty($request->payment_mode)) {
            $customers = $customers->where('payment_mode', 'LIKE', '%' . $request->payment_mode . '%');
        }

        if (!empty($request->from_date)) {
            $customers = $customers->whereDate('created_at', '>=', $request->from_date);
        }
        if (!empty($request->to_date)) {
            $customers = $customers->whereDate('created_at', '<=', $request->to_date);
        }

        if (!empty($request->is_sell)) {
            $is_sell = $request->is_sell == 'Yes' ? 1 : 0;
            $customers = $customers->where('is_sell', $is_sell);
        }

        if (!empty($request->export_excel)) {
            $customers = $customers->get();
            return Excel::download(new \App\Exports\CustomerExport ($customers), 'customers.xlsx');
        }

        if (!empty($request->export_pdf)) {
            $customers = $customers->get();
            $pdf = Pdf::loadView('pdf.customers-list', ['results'=>$customers]);
            return $pdf->stream();
        }

        $customers = $customers->paginate(50);
        $users = User::where('role_id', 2)->orderBy('name', 'ASC')->get();
        return view('admin.customers.index', compact('customers', 'users'));
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $salesmans = User::where('role_id', 2)
                ->orderBy('id', 'DESC')
                ->get();
            return view('admin.customers.customer-edit', compact('customer', 'salesmans'));
        } else {
            return redirect()->back();
        }

    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->vehicle = $request->vehicle ? $request->vehicle : "";
            $customer->name = $request->name ? $request->name :"" ;
            $customer->mobile = $request->mobile ? $request->mobile : "";
            $customer->couple = $request->couple ? $request->couple : 0;
            $customer->men = $request->men ? $request->men : 0;
            $customer->women = $request->women ? $request->women : 0;
            $customer->bill_number = $request->bill_number ? $request->bill_number : "";
            $customer->children = $request->children ? $request->children : 0;
            $customer->cash_amount = $request->cash_amount ? $request->cash_amount : 0;
            $customer->upi_amount = $request->upi_amount ? $request->upi_amount : 0;
            $customer->card_amount = $request->card_amount ? $request->card_amount : 0;
            $customer->amount = $request->amount ? $request->amount : 0;
            $customer->commission = $request->commission ? $request->commission : 0;
            $customer->commission_amount = $request->commission_amount ? $request->commission_amount : 0;
            $customer->checkin_date_time = $request->checkin_date_time  ? $request->checkin_date_time : "";
            $customer->checkout_date_time = $request->checkout_date_time ? $request->checkout_date_time : "";

            if (!empty($request->sales_person)) {
                $customer->sales_person = $request->sales_person;

                if ($request->sales_person == 14) {
                    $customer->is_textile = 1;
                }
            }
            if ($customer->save()) {
                return redirect()->route('admin.customers.index')->with('success', 'Customer  Update Successfully.');
            } else {
                return redirect()->back()->with('error', 'Oops..something has went wrong. Please try again.');
            }

        } else {
            return redirect()->back()->with('error', 'Oops..something has went wrong. Please try again.');
        }
    }

    public function dalyReport(Request $request)
    {
        $checkin_date_time = date('Y-m-d');

        if (!empty($request->checkin_date_time)) {
            $checkin_date_time = $request->checkin_date_time;
        }

        $customers = Customer::with(['user'])->orderBy('id', 'DESC')
            ->whereDate('checkin_date_time', $checkin_date_time)
            ->paginate(25);
        if (!empty($request->export_excel)) {
            return Excel::download(new \App\Exports\DalyReportExport ($customers), 'customers.xlsx');
        }
        return view('admin.customers.daly-report', compact('customers'));
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

        if (!empty($request->sales_person)) {
            $customers = $customers->where('sales_person', $request->sales_person);
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
            $pdf = Pdf::loadView('pdf.admin-monthly-report-pdf', ['results'=>$customers]);
            return $pdf->stream();
        }
        $users = User::where('role_id', 2)->orderBy('name', 'ASC')->get();
        return view('admin.customers.monthly-report', compact('customers', 'users'));
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

        if (!empty($request->sales_person)) {
            $customers = $customers->where('sales_person', $request->sales_person);
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
            $pdf = Pdf::loadView('pdf.admin-yearly-report-pdf', ['results'=>$customers]);
            return $pdf->stream();
        }
        $users = User::where('role_id', 2)->orderBy('name', 'ASC')->get();
        return view('admin.customers.yearly-report', compact('customers', 'users'));
    }

    public function show()
    {
        return view('admin.customers.customer-show');
    }

    public function delete($id)
    {
        try {
            $user = Customer::find($id);
            if ($user) {
                if ($user->delete()) {
                    $result = ['message' => "Customer Deleted Successfully", 'data' => [], 'status' => true];
                    return response($result, 200);
                } else {
                    $result = ['message' => "Something Went Wrong", 'data' => [], 'status' => false];
                    return response($result, 200);
                }
            } else {
                $result = ['message' => "user Data Not Found...", 'data' => [], 'status' => false];
                return response($result, 200);
            }
        } catch (\Exception $e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response($result, 200);
        }
    }

    public function bulkDelete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'month' => ['required'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }

        try {
            $user = Customer::whereYear('checkin_date_time', date('Y', strtotime($request->month)))
                ->whereMonth('checkin_date_time', date('m', strtotime($request->month)));
            if ($user->delete()) {
                $result = ['message' => "Customer Deleted Successfully", 'data' => [], 'status' => true];
                return response($result, 200);
            } else {
                $result = ['message' => "Something Went Wrong", 'data' => [], 'status' => false];
                return response($result, 200);
            }
        } catch (\Exception $e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response($result, 200);
        }
    }
}
