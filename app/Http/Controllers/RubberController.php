<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Excel;
use Validator;
use App\Exports\LogMachineExport;
use App\Models\bankrubber\LogPlanningRb45l1;
use App\Models\bankrubber\LogPlanningRb45l2;
use App\Models\bankrubber\LogPlanningRb45l5;
use App\Models\bankrubber\LogPlanningRb20l3;
use App\Models\bankrubber\LogPlanningRb20l4;


class RubberController extends Controller
{
    public function viewdatrb()
    {
        
        $data = LogPlanningRb45l1::all();
        return view('bankrubber.viewdatrb',['data' => $data]);
    }

    public function viewdataplan()
    {
        try {
            
            $logplan = $request->log_planning;

            if($logplan == 'kn45l1')
            {
                $data = LogPlanningRb45l1::all();
            }
            else if($logplan == 'kn45l2')
            {
                $data = LogPlanningRb45l2::all();
            }
            else if($logplan == 'kn45l5')
            {
                $data = LogPlanningRb45l5::all();
            }
            else if($logplan == 'kn20l3')
            {
                $data = LogPlanningRb20l3::all();
            }
            else if($logplan == 'kn20l4')
            {
                $data = LogPlanningRb20l4::all();
            }

            return view('bankrubber.viewdatrb',['data' => $data]);
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
            $logplan = $request->log_planning;

            if($logplan == 'kn45l1')
            {
                $data = LogPlanningRb45l1::whereBetween('tgl_plan', [$from, $to])->get();
            }
            else if($logplan == 'kn45l2')
            {
                $data = LogPlanningRb45l2::whereBetween('tgl_plan', [$from, $to])->get();
            }
            else if($logplan == 'kn45l5')
            {
                $data = LogPlanningRb45l5::whereBetween('tgl_plan', [$from, $to])->get();
            }
            else if($logplan == 'kn20l3')
            {
                $data = LogPlanningRb20l3::whereBetween('tgl_plan', [$from, $to])->get();
            }
            else if($logplan == 'kn20l4')
            {
                $data = LogPlanningRb20l4::whereBetween('tgl_plan', [$from, $to])->get();
            }

            return Excel::download(new LogMachineExport($data), 'Log Machine.xlsx');
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
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
            $logplan = $request->log_planning;

            if($logplan == 'kn45l1')
            {
                $data = LogPlanningRb45l1::whereBetween('tgl_plan', [$from, $to])->get();
            }
            else if($logplan == 'kn45l2')
            {
                $data = LogPlanningRb45l2::whereBetween('tgl_plan', [$from, $to])->get();
            }
            else if($logplan == 'kn45l5')
            {
                $data = LogPlanningRb45l5::whereBetween('tgl_plan', [$from, $to])->get();
            }
            else if($logplan == 'kn20l3')
            {
                $data = LogPlanningRb20l3::whereBetween('tgl_plan', [$from, $to])->get();
            }
            else if($logplan == 'kn20l4')
            {
                $data = LogPlanningRb20l4::whereBetween('tgl_plan', [$from, $to])->get();
            }

            $pdf = PDF::loadView('exports.pdf.logplanningrb', ['data' => $data]);
            return $pdf->download('Log Machine.pdf');
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
