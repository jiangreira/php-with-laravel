<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use PHPExcel_Worksheet_Drawing;
use DB;
use Excel;


class ExcelController extends Controller
{
    // test export
    public function export()
    {
        //確定可以下載的
        // $cellData = [
        //     ['学号', '姓名', '成绩'],
        //     ['10001', 'AAAAA', '99'],
        //     ['10002', 'BBBBB', '92'],
        //     ['10003', 'CCCCC', '95'],
        //     ['10004', 'DDDDD', '89'],
        //     ['10005', 'EEEEE', '96'],
        // ];
        // Excel::create('学生成绩', function ($excel) use ($cellData) {
        //     $excel->sheet('score', function ($sheet) use ($cellData) {
        //         $sheet->rows($cellData);
        //     });
        // })->export('xls');
        $filename = 'File Name';

        Excel::create($filename, function ($excel) {

            $excel->sheet('sheet name', function ($sheet) {
                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('img/laravel.png')); //your image path
                $objDrawing->setCoordinates('A2');
                $objDrawing->setWorksheet($sheet);
            });
        })->export('xls');
    }
    public function exportlist(Request $request)
    {
        $data = $request->perioddata;
        $num = count($data);
        // 定義sql iddetail條件
        $words = "";
        for ($i = 0; $i < $num; $i++) {
            if ($i == 0) {
                $words = $data[$i];
            } else {
                $words = $words . ',' . $data[$i];
            }
        }
        // 撈資料
        if ($num == 0) {
            $rows = DB::SELECT('SELECT * FROM detail WHERE iddetail=' . $words);
        } else {
            $rows = DB::SELECT('SELECT * FROM detail WHERE iddetail IN(' . $words . ')');
        }
        // 再綁定些數據

        $all[] = array(
            '期數', '寬頻上網_固網_ADSL', '寬頻上網_固網_FTTX', '寬頻上網_固網_Cable_Modem',
            '寬頻上網_固網_Leased_Line', '寬頻總數', '無線行動寬頻_PWLAN', '無線行動寬頻_3G數據',
            '無線行動寬頻_4G數據', '無線行動寬頻總數', '行動上網_3GDataCard', '行動上網_3GPhone',
            '行動上網_4GDataCard', '行動上網_4GPhone', '行動上網總數'
        );

        foreach ($rows as $key => $row) {
            $all[] = array(
                'Period' => $row->Period,
                'B_ADSL' => $row->B_ADSL,
                'B_Cable_Modem' => $row->B_Cable_Modem,
                'B_FTTX' => $row->B_FTTX,
                'B_Leased_Line' => $row->B_Leased_Line,
                'B_Total' => $row->B_ADSL + $row->B_Cable_Modem + $row->B_FTTX + $row->B_Leased_Line,
                'WB_PWLAN' => $row->WB_PWLAN,
                'WB_3GDate' => $row->WB_3GDate,
                'WB_4GDate' => $row->WB_4GDate,
                'WB_Total' => $row->WB_PWLAN + $row->WB_3GDate + $row->WB_4GDate,
                'M_3GDataCard' => $row->M_3GDataCard,
                'M_3GPhone' => $row->M_3GPhone,
                'M_4GDataCard' => $row->M_4GDataCard,
                'M_4GPhone' => $row->M_4GPhone,
                'M_Total' => $row->M_3GDataCard + $row->M_3GPhone + $row->M_4GDataCard + $row->M_4GPhone
            );
        }


        $exceldoc = Excel::create('數據清單', function ($excel) use ($all) {
            $excel->sheet('清單', function ($sheet) use ($all) {
                $sheet->fromArray($all, null, 'A1', true, false);
            });
        });

        $exceldoc = $exceldoc->string('xlsx'); //change xlsx for the format you want, default is xls
        $response =  array(
            'name' => "filename", //no extention needed
            'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64," . base64_encode($exceldoc) //mime type of used format
        );
        return response()->json($response);
    }
}
