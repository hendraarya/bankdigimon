<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportWronlineExport implements FromView, ShouldAutoSize
{
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('exports.excel.logwronline', [
            'data' => $this->data
        ]);
    }
}
