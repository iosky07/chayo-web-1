<?php

namespace App\Http\Livewire\Table;

use App\Models\Customer;
use App\Models\Log;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Main extends Component
{
    use WithPagination;

    public $model;
    public $name;
    public $customer;

    public $perPage = 10;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';

    protected $listeners = [ "deleteItem" => "delete_item", "addInvoice" => "add_invoice", "addPayment" => "add_payment" ];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function get_pagination_data ()
    {
        switch ($this->name) {
            case 'user':
                $users = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.user',
                    "users" => $users,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.user.new'),
                            'create_new_text' => 'Buat User Baru',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;

            case 'member':
                $members = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.member',
                    "members" => $members,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.member.create'),
                            'create_new_text' => 'Buat Member Baru',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;

            case 'student':
                $students = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.student',
                    "students" => $students,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.student.create'),
                            'create_new_text' => 'Buat Mahasiswa Baru',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;

            case 'studentDetail':
                $studentDetails = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.student-detail',
                    "studentDetails" => $studentDetails,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.student.create'),
                            'create_new_text' => 'Buat Mahasiswa Baru',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;

            case 'offense':
                $offenses = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.offense',
                    "offenses" => $offenses,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.offense.create'),
                            'create_new_text' => 'Buat Jenis Pelanggaran',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;

            case 'addition':
                $additions = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.addition',
                    "additions" => $additions,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.addition.create'),
                            'create_new_text' => 'Buat Jenis Kepatuhan',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;

            case 'customer':
                $customers = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.customer',
                    "customers" => $customers,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.customer.create'),
                            'create_new_text' => 'Buat Customer Baru',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;

            case 'packetTag':
                $packetTags = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.packet-tag',
                    "packetTags" => $packetTags,
                    "data" => array_to_object([
                        'href' => [
                            'create_new' => route('admin.packet-tag.create'),
                            'create_new_text' => 'Buat Paket Baru',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;

            case 'log':
                $logs = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage);

                return [
                    "view" => 'livewire.table.log',
                    "logs" => $logs,
                    "data" => array_to_object([
                        'href' => [
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;

            case 'invoice':
                $invoices = $this->model::search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate(100);
//                dd($this->perPage);

                return [
                    "view" => 'livewire.table.invoice',
                    "invoices" => $invoices,
                    "data" => array_to_object([
                        'href' => [
                            'create_new_invoice' => route('admin.create_with_id', intval(substr(url()->current(), -12))),
                            'create_new_text' => 'Buat invoice Baru',
                            'export' => '#',
                            'export_text' => 'Export'
                        ]
                    ])
                ];
                break;

            default:
                # code...
                break;
        }
    }

    public function delete_item ($id)
    {
//        dd($this->name);
        $data = $this->model::find($id);

        if (!$data) {
            $this->emit("deleteResult", [
                "status" => false,
                "message" => "Gagal menghapus data " . $this->name
            ]);
            return;
        }

        $data->delete();
        $this->emit("deleteResult", [
            "status" => true,
            "message" => "Data " . $this->name . " berhasil dihapus!"
        ]);

        $this->log = [
            'user_id' => Auth::id(),
            'access' => 'delete',
            'activity' => 'delete id '.$id.' from '.$this->name.' table.'
        ];

        Log::create($this->log);

        if ($this->name == 'invoice') {
            return redirect(url()->previous());
        }

    }

    public function add_invoice ($id)
    {
        $data = $this->model::find($id);

        $pdf = Pdf::loadView('invoices.invoice', compact('data'));

        if (!$data) {
            $this->emit("addInvoiceResult", [
                "status" => false,
                "message" => "Gagal menghapus data " . $this->name
            ]);
            return;
        }

        $this->emit("addInvoiceResult", [
            "status" => true,
            "message" => "Data invoice" . $this->name . " berhasil ditambah!"
        ]);

        $this->log = [
            'user_id' => Auth::id(),
            'access' => 'create',
            'activity' => 'create id '.$id.' from '.$this->name.' table.'
        ];

//        Log::create($this->log);

        return $pdf->stream('invoice-'.$data['name'].'-'.$data['selected_date'].'.pdf');

    }

    public function add_payment ($id)
    {
        $data = $this->model::find($id);

        $this->customer['total_bill'] = 0;
        $this->customer['amount'] = 0;
        $this->customer['status'] = 'paid';
        Customer::find($id)->update($this->customer);

        if (!$data) {
            $this->emit("addPaymentResult", [
                "status" => false,
                "message" => "Gagal menambah data " . $this->name
            ]);
            return;
        }

        $this->emit("addPaymentResult", [
            "status" => true,
            "message" => "Data pembayaran " . $this->name . " berhasil ditambah!"
        ]);

        $this->log = [
            'user_id' => Auth::id(),
            'access' => 'create',
            'activity' => 'create payment for Customer id '.$id.' from '.$this->name.' table.'
        ];

//        Log::create($this->log);

    }

    public function render()
    {
        $data = $this->get_pagination_data();

        return view($data['view'], $data);
    }
}
