<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public $customer;

    public function generatePDF($customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $date = Carbon::now();
        $amount = $customer['amount'] + 1;
        $this->customer['amount'] = $amount;
        $this->customer['total_bill'] = $customer['bill'] * $amount;
        Customer::find($customerId)->update($this->customer);

        $pdf = Pdf::loadView('invoices.invoice', compact('customer'));

        return $pdf->download('invoice-'.$customer['name'].'-'.$date.'.pdf');
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
