<?php

namespace App\Http\Controllers;

use DB;
use View;
use Illuminate\Http\Request;
use Illuminate\Support\CollectionstdClass;
use Illuminate\Routing\UrlGenerator;
use Session;
use Redirect;

class NavLinkController extends Controller
{
    public function Showmenu()
    {
        return view('menu')->with('nowwhere', 'menu');
    }
    public function ShowList()
    {
        if (Session::has('username')) {
            $rows = DB::table('detail')->get();
            $chkrows = DB::table('detail')->count();
            if ($chkrows >= 1) {
                foreach ($rows as $key => $row) {
                    $data[] = array(
                        'Id' => $row->iddetail,
                        'Period' => $row->Period,
                        'BCable' => $row->B_ADSL + $row->B_Cable_Modem + $row->B_FTTX + $row->B_Leased_Line,
                        'BWireless' => $row->WB_PWLAN + $row->WB_3GDate + $row->WB_4GDate,
                        'Mobile' => $row->M_3GDataCard + $row->M_3GPhone + $row->M_4GDataCard + $row->M_4GPhone
                    );
                };
            } else {
                $data = 'nodata';
            }

            return view('ProdList')->with('data', $data)->with('nowwhere', 'list');
        } else {
            return redirect::to('/sign');
        }
    }
    public function Showcreate()
    {
        if (Session::has('username')) {
            return view('ProdCreate')->with('nowwhere', 'create');
        } else {
            return redirect::to('/sign');
        }
    }
    public function Showcharts()
    {
        if (Session::has('username')) {
            return view('ProdCharts')->with('nowwhere', 'charts');
        } else {
            return redirect::to('/sign');
        }
    }
}
