<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LogMachineExport implements FromView, ShouldAutoSize
{
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('exports.excel.logplanningrb', [
            'data' => $this->data
        ]);
    }
}