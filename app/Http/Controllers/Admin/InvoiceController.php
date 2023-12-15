<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public $customer;

    public function index_with_id($id)
    {
        $name = Customer::whereId($id)->value('name');
        return view('pages.invoice.index', [
            'inv' => Invoice::class
        ], compact('id', 'name'));
    }

    public function create_with_id($id)
    {
        return view('pages.invoice.create', compact('id'));
    }

    public function edit($id)
    {
        return view('pages.invoice.edit', compact('id'));
    }

    public function generate_invoice($invoiceId)
    {
        $getUrl = url()->previous();
        $id = intval(substr($getUrl, -12));
        $customer = Customer::findOrFail($id);
        $invoice = Invoice::findOrFail($invoiceId);

        $pdf = Pdf::loadView('invoices.invoice', compact('customer'));

        return $pdf->stream('invoice-'.$customer['name'].'-'.$invoice['selected_date'].'.pdf');
    }

    public function payment($customerId)
    {
        $this->customer['total_bill'] = 0;
        $this->customer['amount'] = 0;
        $this->customer['status'] = 'paid';
        Customer::find($customerId)->update($this->customer);

        $this->emit('swal:alert', [
            'type'    => 'success',
            'title'   => 'Pembayaran Berhasil',
            'timeout' => 3000,
            'icon'=>'success'
        ]);
        $this->emit('redirect');
    }
}
