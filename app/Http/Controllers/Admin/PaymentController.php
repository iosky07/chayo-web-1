<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Payment;

class PaymentController extends Controller
{
    public $customer;

    public function index()
    {
        return view('pages.payment.index', [
            'pay' => Payment::class
        ]);
    }

    public function payment_index_with_id($id)
    {
        $name = Customer::whereId($id)->value('name');
        return view('pages.payment.index', [
            'pay' => Payment::class
        ], compact('id', 'name'));
    }

    public function payment_create_with_id($id)
    {
        $action = 'create';
        return view('pages.payment.create', compact('id'));
    }

    public function edit($id)
    {
        return view('pages.payment.edit', compact('id'));
    }
}
