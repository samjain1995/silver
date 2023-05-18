<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class DalyReportExport implements FromView, WithTitle
{
    public function __construct($input)
    {
        $this->input = $input;
    }

    public function view(): View
    {
        $customers = $this->input;

        return view('exports.daly-report', ['customers' => $customers]);
    }
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Customers';
    }
}
