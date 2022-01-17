<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Excel;
use Validator;
use App\Exports\LogMachineExport;
use App\Models\bankwronline\LogWronline;

class WronlineController extends Controller
{
    public function viewdatwronline()
    {
        
        $data = LogWronline::all();
        return view('bankwronline.viewdatwronline',['data' => $data]);
    }
}
