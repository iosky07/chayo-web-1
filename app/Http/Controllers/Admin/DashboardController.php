<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\RouterosAPI;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
////        $ip = '103.164.193.35';
////        $user = 'Arie';
////        $pass = '190701';
////        $API = new RouterosAPI();
////        $API->debug('false');
////
////        if ($API->connect($ip, $user, $pass)) {
////            $identitas = $API->comm('/system/console/', array('command' => 'new-terminal'));
//////            $identitas = $API->comm('/system/telnet/192.168.122.122');
////        } else {
////            return 'Koneksi Gagal';
////        }
//
//        $API = new RouterosAPI();
//        $API->debug('false');
//
//        $host = '103.164.193.35'; // Ganti dengan IP MikroTik
//        $username = 'yoski';
//        $password = 'yoskiapik';
//
//        if ($API->connect($host, $username, $password)) {
//            // Buka sesi console baru
//            $identitas = $API->comm('/ppp/secret/print');
//
//            // Lakukan sesuatu dengan sesi console
//
//            // Tutup koneksi setelah selesai
//            $API->disconnect();
//        } else {
//            echo 'Tidak dapat terhubung ke MikroTik.';
//        }
//
////        dd(count($identitas));
////        dd($identitas[193]);
//        $array = [];
//        foreach ($identitas as $item) {
//            $temp_array = [];
////            dd($item['name']);
//            $temp_array[] = $item['name'];
//            $temp_array[] = $item['password'];
////            dd($temp_array);
//            $array[] = $temp_array;
//        }
//
//        // EXPORT TO CSV
////        $filePath = storage_path('app/chayo_secret_data.csv');
////
////        $file = fopen($filePath, 'w');
////
////        foreach ($array as $row) {
////            fputcsv($file, $row);
////        }
////
////        fclose($file);
////
////        return response()->download($filePath)->deleteFileAfterSend(true);
//
////        dd('berhasil');

        $customer = Customer::all()->count();
        $sum_total_bill = Customer::sum('total_bill');

        $month_total_bill = [];
        $invoices = Invoice::whereStatus('unpaid')->orderBy('selected_date', 'asc')->get();
        for ($month = 0; $month <= $invoices->count()-1; $month++) {
//            dd($invoices->pluck('customer_id')[$month]);
            $temp = [];
            $temp[] = Carbon::parse($invoices->pluck('selected_date')[$month])->translatedFormat('F Y');
            $temp[] = Customer::whereId($invoices->pluck('customer_id')[$month])->pluck('bill')[0];
            $month_total_bill[] = $temp;
        }
//        dd($month_total_bill);
        $summedData = [];
        foreach ($month_total_bill as $entry) {
            $month = $entry[0];
            $amount = $entry[1];

            // If the month already exists in $summedData, add the amount to the existing total
            if (array_key_exists($month, $summedData)) {
                $summedData[$month] += $amount;
            } else {
                // If the month doesn't exist, create a new entry in $summedData
                $summedData[$month] = $amount;
            }
        }
        // Convert the associative array back to the desired format
        $invoice_months = array_map(function ($month, $amount) {
            return [$month, $amount];
        }, array_keys($summedData), $summedData);
//        dd($invoice_months);

        $this_month_i = Carbon::parse(Carbon::now())->translatedFormat('F Y');
        $this_month_index_i = array_search($this_month_i, array_column($invoice_months, 0));

        $subset = array_slice($invoice_months, 0, $this_month_index_i);
        $values = array_column($subset, 1);
        $prev_month_i = array_sum($values);

        $subset = array_slice($invoice_months, 0, $this_month_index_i+1);
        $values = array_column($subset, 1);
        $sum_month_i = array_sum($values);

        #logika payments
        $month_total_payment = [];
        $payments = Payment::whereStatus('accept')->orderBy('updated_at', 'asc')->get();
        for ($month = 0; $month <= $payments->count()-1; $month++) {
            $temp = [];
            $temp[] = Carbon::parse($payments->pluck('updated_at')[$month])->translatedFormat('F Y');
            $temp[] = $payments->pluck('nominal')[$month];
            $month_total_payment[] = $temp;
        }

        $summedData = [];
        foreach ($month_total_payment as $entry) {
            $month = $entry[0];
            $amount = $entry[1];

            // If the month already exists in $summedData, add the amount to the existing total
            if (array_key_exists($month, $summedData)) {
                $summedData[$month] += $amount;
            } else {
                // If the month doesn't exist, create a new entry in $summedData
                $summedData[$month] = $amount;
            }
        }

        // Convert the associative array back to the desired format
        $payment_months = array_map(function ($month, $amount) {
            return [$month, $amount];
        }, array_keys($summedData), $summedData);

        $this_month_p = Carbon::parse(Carbon::now())->translatedFormat('F Y');
        $this_month_index_p = array_search($this_month_p, array_column($payment_months, 0));

        $subset = array_slice($payment_months, 0, $this_month_index_p);
        $values = array_column($subset, 1);
        $prev_month_p = array_sum($values);

        $subset = array_slice($payment_months, 0, $this_month_index_p+1);
        $values = array_column($subset, 1);
        $sum_month_p = array_sum($values);

        return view('dashboard', compact('customer', 'sum_total_bill', 'invoice_months', 'this_month_index_i', 'prev_month_i', 'sum_month_i', 'payment_months', 'this_month_index_p', 'prev_month_p', 'sum_month_p'));
    }
}
