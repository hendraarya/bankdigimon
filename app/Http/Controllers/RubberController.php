<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
     // get list data untuk datatable berdasarkan data yg dipilih 
     public function getListData(Request $request)
     {
         $array = [
             // key nya itu field di inputan html => value nya buat nama table di databasenya
             // key => value
             'LogPlanningRb20l3' => 'backup_planrubber_20l3',
             'LogPlanningRb20l4' => 'backup_planrubber_20l4',
             'LogPlanningRb45l1' => 'backup_planrubber_45l1',
             'LogPlanningRb45l2' => 'backup_planrubber_45l2',
             'LogPlanningRb45l5' => 'backup_planrubber_45l5'
         ];
 
         $tableName = $array[ $request->jenis_table];
         $data = \DB::table($tableName)->get();
 
         // kirim response sebagai JSON format ke front nya / ke blade nya
         return response()->json($data, 200);
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
