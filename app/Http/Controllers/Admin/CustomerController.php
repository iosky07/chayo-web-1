<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\DateMonth;
use App\Models\Invoice;
use App\Models\PacketTag;
use Carbon\Carbon;
use Cassandra\Custom;
use DateTime;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public $date_month;

    public function index()
    {
        $current_date = Carbon::now();
        $last_month = DateMonth::latest()->first();
        $last_month = Carbon::parse($last_month['save_date_per_month']);
        $daysInLastMonth = $last_month->daysInMonth;
        $firstDayOfMonth = $last_month->firstOfMonth();
        $daysDifference = $current_date->diffInDays($firstDayOfMonth);
//        dd($daysDifference);

        $customers = Customer::all();

        if ($daysDifference > 20) {
            foreach ($customers as $customer) {
                Carbon::setLocale('id');

                try {
                    $last_invoice_date = Invoice::whereCustomerId($customer['id'])->latest()->first();
                    $last_invoice_date = Carbon::parse($last_invoice_date['selected_date']);
                    $invoice_month = $last_invoice_date->format('m');
                    $invoice_year = $last_invoice_date->format('Y');
                    $data_null = False;
                } catch (\Exception $e) {
                    $data_null = True;
                }

                $current_date = Carbon::now();
                $current_month = $current_date->format('m');
                $current_year = $current_date->format('Y');
                if ($data_null) {

                    $id = $customer['id'];

                    $this->invoice['selected_date'] = $current_date;
                    $this->invoice['customer_id'] = $id;

                    Invoice::create($this->invoice);
                    $invoice_amount = Invoice::whereCustomerId($id)->whereStatus('unpaid')->count();
                    $customer = Customer::findOrFail($id);

                    $this->customer['status'] = 'unpaid';
                    $this->customer['total_bill'] = $customer['bill'] * $invoice_amount;

                    Customer::find($id)->update($this->customer);
                } else {
                    if ($current_year == $invoice_year) {
                        if ($current_month > $invoice_month) {
                            dd('tengah'.$customer['id']);

                            $id = $customer['id'];

                            $this->invoice['selected_date'] = $current_date;
                            $this->invoice['customer_id'] = $id;

                            Invoice::create($this->invoice);
                            $invoice_amount = Invoice::whereCustomerId($id)->whereStatus('unpaid')->count();
                            $customer = Customer::findOrFail($id);

                            $this->customer['status'] = 'unpaid';
                            $this->customer['total_bill'] = $customer['bill'] * $invoice_amount;

                            Customer::find($id)->update($this->customer);
                        }
                    } elseif ($current_year > $invoice_year) {
                        dd('bawah'.$customer['id']);
                        $id = $customer['id'];

                        $this->invoice['selected_date'] = $current_date;
                        $this->invoice['customer_id'] = $id;

                        Invoice::create($this->invoice);
                        $invoice_amount = Invoice::whereCustomerId($id)->whereStatus('unpaid')->count();
                        $customer = Customer::findOrFail($id);

                        $this->customer['status'] = 'unpaid';
                        $this->customer['total_bill'] = $customer['bill'] * $invoice_amount;

                        Customer::find($id)->update($this->customer);
                    }
                }
            }
//            $current_date = Carbon::parse("2024-01-12 00:00:00");
            $this->date_month['save_date_per_month'] = $current_date->firstOfMonth();
            DateMonth::create($this->date_month);
        }


        $now = Carbon::now()->toDate();
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

    public function new_month() {
        Carbon::setLocale('id');

        try {
            $last_invoice_date = Invoice::whereCustomerId($id)->latest()->first();
            $last_invoice_date = Carbon::parse($last_invoice_date['selected_date']);
            $invoice_month = $last_invoice_date->format('m');
            $invoice_year = $last_invoice_date->format('Y');
            $data_null = False;
        } catch (\Exception $e) {
            $data_null = True;
        }

        $current_date = Carbon::now();
        $current_month = $current_date->format('m');
        $current_year = $current_date->format('Y');
        if ($data_null) {

            $getUrl = url()->current();
            $id = intval(substr($getUrl, -12));

            $this->invoice['selected_date'] = $current_date;
            $this->invoice['customer_id'] = $id;

            Invoice::create($this->invoice);
            $invoice_amount = Invoice::whereCustomerId($id)->whereStatus('unpaid')->count();
            $customer = Customer::findOrFail($id);

            $this->customer['status'] = 'unpaid';
            $this->customer['total_bill'] = $customer['bill'] * $invoice_amount;

            Customer::find($id)->update($this->customer);
        } else {
            if ($current_year == $invoice_year) {
                if ($current_month > $invoice_month) {
                    $getUrl = url()->previous();
                    $id = intval(substr($getUrl, -12));

                    $this->invoice['selected_date'] = $current_date;
                    $this->invoice['customer_id'] = $id;

                    Invoice::create($this->invoice);
                    $invoice_amount = Invoice::whereCustomerId($id)->whereStatus('unpaid')->count();
                    $customer = Customer::findOrFail($id);

                    $this->customer['status'] = 'unpaid';
                    $this->customer['total_bill'] = $customer['bill'] * $invoice_amount;

                    Customer::find($id)->update($this->customer);
                }
            } elseif ($current_year > $invoice_year) {
                $getUrl = url()->previous();
                $id = intval(substr($getUrl, -12));

                $this->invoice['selected_date'] = $current_date;
                $this->invoice['customer_id'] = $id;

                Invoice::create($this->invoice);
                $invoice_amount = Invoice::whereCustomerId($id)->whereStatus('unpaid')->count();
                $customer = Customer::findOrFail($id);

                $this->customer['status'] = 'unpaid';
                $this->customer['total_bill'] = $customer['bill'] * $invoice_amount;

                Customer::find($id)->update($this->customer);
            }
        }
    }

}
