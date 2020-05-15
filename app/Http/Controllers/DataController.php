<?php

namespace App\Http\Controllers;


use Auth;
use DB;
use DateTime;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use View;

class DataController extends Controller
{
    public function add(Request $request)
    {
        //確認period有輸入
        // if ($request->period == 'null') {
        //     session::flash('error', '期數不得為空');
        //     return Redirect::back()
        //         ->withInput();
        // };
        // $chk = is_numeric($request->period);
        // if ($chk == 'null' || empty($chk)) {
        //     session::flash('error', '不得輸入文字，請輸入數字');
        //     return Redirect::back()
        //         ->withInput();
        // }
        //取得現在時間
        $now = new DateTime();
        DB::table('detail')->insert([
            'Period' => $request->period,
            'B_ADSL'    => !empty($request->BADSL) ? $request->BADSL : '0',
            'B_Cable_Modem' => !empty($request->BCableModem) ? $request->BCableModem : '0',
            'B_FTTX' => !empty($request->BFTTX) ? $request->BFTTX : '0',
            'B_Leased_Line' => !empty($request->BLeasedLine) ? $request->BLeasedLine : '0',
            'WB_PWLAN' => !empty($request->WBPWLAN) ? $request->WBPWLAN : '0',
            'WB_3GDate' => !empty($request->WB3G) ? $request->WB3G : '0',
            'WB_4GDate' => !empty($request->WB4G) ? $request->WB4G : '0',
            'M_3GPhone' => !empty($request->M3GPhone) ? $request->M3GPhone : '0',
            'M_3GDataCard' => !empty($request->M3GDataCard) ? $request->M3GDataCard : '0',
            'M_4GPhone' => !empty($request->M4GPhone) ? $request->M4GPhone : '0',
            'M_4GDataCard' => !empty($request->M4GDataCard) ? $request->M4GDataCard : '0',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        //確認新增成功則導向
        if (DB::select('select * from detail where Period = "' . $request->period . '"', [1])) {
            Session::flash('createok', "成功");
            return Redirect::to('list');
        } else {
            //沒成功則回去繼續新增
            return Redirect::to('/create')
                ->withErrors(['fail' => '新增失敗'])
                ->withInput();
        }
    }
    public function ShowEdit($id)
    {
        $data = DB::Select('select * from detail where iddetail="' . $id . '"', [1]);
        $datajson = json_encode($data);
        return view('ProdEdit')->with(['Id' => $id, 'data' => $datajson]);
    }
    public function Edit(Request $request)
    {
        $data = $request->all();
        print_r($data);
        $now = new DateTime();
        $updated = DB::table('detail')->where('iddetail', $request->Id)->update([
            'B_ADSL'    =>  $request->BADSL,
            'B_Cable_Modem' =>  $request->BCableModem,
            'B_FTTX' => $request->BFTTX,
            'B_Leased_Line' => $request->BLeasedLine,
            'WB_PWLAN' => $request->WBPWLAN,
            'WB_3GDate' => $request->WB3G,
            'WB_4GDate' =>  $request->WB4G,
            'M_3GPhone' => $request->M3GPhone,
            'M_3GDataCard' => $request->M3GDataCard,
            'M_4GPhone' => $request->M4GPhone,
            'M_4GDataCard' =>  $request->M4GDataCard,
            'updated_at' => $now,
        ]);
        $period = $request->Period;
        if ($updated) {
            Session::flash('updateok', $period . "修改成功");
            return redirect::to('/list');
        } else {
            Session::flash('updatenotok', $period . "修改失敗");
            return redirect()->back();
        }
    }
    public function ChoosePeriod()
    {
        $data = DB::Select('Select iddetail,Period from detail order by "Period" Asc LIMIT 3');
        $datajson = json_encode($data);
        return $datajson;
    }
    public function Chart1Period(Request $request)
    {
        $data = $request->perioddata;
        $only = $request->num;
        if ($only === '0') {
            $rows = DB::Select('SELECT * FROM detail where iddetail="' . $data . '"');
        } elseif ($only === '1') {
            $rows = DB::Select('SELECT * FROM detail where iddetail in(' . $data . ')');
        }

        foreach ($rows as $row) {
            // $row->other = array(
            $rem[] = array(
                'Period'=>$row->Period,
                'B_ADSL'    =>  $row->B_ADSL,
                'B_Cable_Modem' =>  $row->B_Cable_Modem,
                'BCable' => $row->B_ADSL + $row->B_Cable_Modem + $row->B_FTTX + $row->B_Leased_Line,
                'BWireless' => $row->WB_PWLAN + $row->WB_3GDate + $row->WB_4GDate,
                'Mobile' => $row->M_3GDataCard + $row->M_3GPhone + $row->M_4GDataCard + $row->M_4GPhone
            );
        }
        $re = json_encode($rem);
        return $re;
    }
    public function deletedetail(Request $request)
    {
        $data = $request->deldata;
        $num = count($data);
        $words = "";

        for ($i = 0; $i < $num; $i++) {
            if ($i == 0) {
                $words = $data[$i];
            } else {
                $words = $words . ',' . $data[$i];
            }
        }
        if ($num == 0) {
            return 'noid';
        } elseif ($num == 1) {
            $ans = DB::table('detail')->where('iddetail', $words)->delete();
        } else {
            $ans = DB::DELETE('DELETE FROM detail WHERE iddetail IN(' . $words . ')');
        }

        if ($ans) {
            return 'ok';
        }
    }
}
