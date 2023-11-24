<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\PacketTag;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $now = Carbon::now()->toDate();
        $dateString = "20-12-2023";
        $dateObject = DateTime::createFromFormat('d-m-Y', $dateString);
        $diff = date_diff($now, DateTime::createFromFormat('d-m-Y', $dateString));
//        dd($diff->format("%a Hari"));
        return view('pages.customer.index', [
            'cust' => Customer::class
        ], compact('now'));
    }

    public function create()
    {
        return view('pages.customer.create');
    }

    public function edit($id)
    {
        $packet_tags_option = PacketTag::all();
//        $details = PacketTag::whereStudentId($id)->get();
        return view('pages.customer.edit', compact('id', 'packet_tags_option'));
    }

}
