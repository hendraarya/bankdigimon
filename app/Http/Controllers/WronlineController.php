<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Excel;
use Validator;
use App\Exports\ReportWronlineExport;
use App\Models\bankwronline\LogWronline;

class WronlineController extends Controller
{
    public function viewdatwronline()
    {
        
        $data = LogWronline::all();
        return view('bankwronline.viewdatwronline',['data' => $data]);
    }

    public function exportPDF(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date_from' => 'required|string|date_format:d/m/Y',
            'date_to' => 'required|string|date_format:d/m/Y',
        ]);

        if($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        try {
            $from = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_from)));
            $to = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_to)));

            $data = LogWronline::whereBetween('drepair', [$from, $to])->get();

            $pdf = PDF::loadView('exports.pdf.logwronline', ['data' => $data]);
            return $pdf->download('Report WR Online.pdf');
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function exportExcel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date_from' => 'required|string|date_format:d/m/Y',
            'date_to' => 'required|string|date_format:d/m/Y',
        ]);

        if($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        try {
            $from = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_from)));
            $to = date('Y-m-d', strtotime(str_replace('/', '-', $request->date_to)));

            $data = LogWronline::whereBetween('drepair', [$from, $to])->get();

            return Excel::download(new ReportWronlineExport($data), 'Report Wr Online.xlsx');
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
