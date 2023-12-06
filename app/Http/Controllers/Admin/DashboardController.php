<?php

namespace App\Http\Controllers\Admin;

use App\Models\RouterosAPI;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
//        $ip = '103.164.193.35';
//        $user = 'Arie';
//        $pass = '190701';
//        $API = new RouterosAPI();
//        $API->debug('false');
//
//        if ($API->connect($ip, $user, $pass)) {
//            $identitas = $API->comm('/system/console/', array('command' => 'new-terminal'));
////            $identitas = $API->comm('/system/telnet/192.168.122.122');
//        } else {
//            return 'Koneksi Gagal';
//        }

        $API = new RouterosAPI();
        $API->debug('false');

        $host = '103.164.193.35'; // Ganti dengan IP MikroTik
        $username = 'yoski';
        $password = 'yoskiapik';

        if ($API->connect($host, $username, $password)) {
            // Buka sesi console baru
            $identitas = $API->comm('/ppp/secret/print');

            // Lakukan sesuatu dengan sesi console

            // Tutup koneksi setelah selesai
            $API->disconnect();
        } else {
            echo 'Tidak dapat terhubung ke MikroTik.';
        }

//        dd(count($identitas));
//        dd($identitas[193]);
        $array = [];
        foreach ($identitas as $item) {
            $temp_array = [];
//            dd($item['name']);
            $temp_array[] = $item['name'];
            $temp_array[] = $item['password'];
//            dd($temp_array);
            $array[] = $temp_array;
        }

        // EXPORT TO CSV
//        $filePath = storage_path('app/chayo_secret_data.csv');
//
//        $file = fopen($filePath, 'w');
//
//        foreach ($array as $row) {
//            fputcsv($file, $row);
//        }
//
//        fclose($file);
//
//        return response()->download($filePath)->deleteFileAfterSend(true);

//        dd('berhasil');
        return view('dashboard');
    }
}
