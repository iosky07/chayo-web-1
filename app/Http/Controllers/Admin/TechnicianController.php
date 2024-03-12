<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technician;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RouterosAPI;

class TechnicianController extends Controller
{
    public function index() {
        return view('pages.technician.index', [
            'technician' => Technician::class
        ]);
    }

    public function index_check($sn) {

        $ip = '103.164.192.124';
        $user = 'Arie';
        $pass = '190701';
        $API = new RouterosAPI();
        $API->debug('false');

        if ($API->connect($ip, $user, $pass)) {
            $identitas = $API->comm('/ppp/secret/print');
//            $identitas = $API->comm('/interface/pppoe-server/secret/print');
//            $identitas = $API->comm('/interface/wireless/registration-table/print');
        } else {
            return 'Koneksi Gagal';
        }

//        dd($identitas);
        $search = $sn;

        $array = [];
        foreach ($identitas as $item) {
//            dd('p');
            $temp_array = [];
            $temp_array[] = $item['name'];
            $temp_array[] = $item['password'];
            $array[] = $temp_array;
//            dd($this->search['sn'], $item['password']);
            if ($item['password'] == $search) {
//                dd('p');
                $result = $temp_array;
                break;
            }
        }
        if(isset($result)) {
            $status = 'ada';
            $result_info = $result;

            if ($API->connect($ip, $user, $pass)) {
                $identitas = $API->comm('/ppp/active/print');
            } else {
                return 'Koneksi Gagal';
            }
            $array_act_conn = [];
            foreach ($identitas as $item) {
                $temp_array_act_conn = [];
                $temp_array_act_conn[] = $item['name'];
                $temp_array_act_conn[] = $item['uptime'];
                $array_act_conn[] = $temp_array_act_conn;
                if ($item['name'] == $result[0]) {
                    $result_act_conn = $temp_array_act_conn;
                    break;
                } else {
                    $result_act_conn = [];
                }
            }

            //Menjadikan format uptime menjadi Minggu hari Jam Menit Detik
            if (count($result_act_conn) > 0) {
                $parts = explode(' ', $result_act_conn[1]);

                $days = 0;
                $hours = 0;
                $minutes = 0;
                $seconds = 0;
                $value = '';

                foreach (str_split($parts[0]) as $part) {
                    if (is_numeric($part)) {
                        $value .= $part;
                    }

                    switch ($part) {
                        case 'w':
                            $days += $value * 7;
                            $value = 0;
                        case 'd':
                            $days += $value;
                            $value = 0;
                        case 'h':
                            $hours += $value;
                            $value = 0;
                        case 'm':
                            $minutes += $value;
                            $value = 0;
                        case 's':
                            $seconds += $value;
                            $value = 0;

                    }
                }

                $result_act_conn[1] = "$days Hari $hours jam $minutes menit $seconds detik";
            }
        } else {
            $status = 'kosong';
            $result_act_conn = [];
            $result_info = [];
        }
//        dd($result_act_conn, $result_info);

        return view('pages.technician.index', [
            'technician' => Technician::class
        ], compact('result_act_conn', 'result_info', 'status'));
    }

    public function user_offline() {
        


        return view('pages.technician.index', [
            'technician' => Technician::class
        ], compact());
    }
}
