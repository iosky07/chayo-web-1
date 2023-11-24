<?php

namespace App\Http\Controllers\Admin;

use App\Models\RouterosAPI;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
        $ip = '103.164.193.35';
//        $ip = '192.168.5.2';
        $user = 'Arie';
        $pass = '190701';
        $API = new RouterosAPI();
        $API->debug('false');

        if ($API->connect($ip, $user, $pass)) {
            $identitas = $API->comm('/terminal');
//            $identitas = $API->comm('/system/telnet/192.168.122.122');
//            dd('im here');
//            return 'Koneksi Berhasil!!!';
        } else {
            return 'Koneksi Gagal';
        }

        dd($identitas);

        return view('admin.dashboard');
    }
}
