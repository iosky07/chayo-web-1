<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\PacketTag;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class CustomerForm extends Component
{
    use WithFileUploads;
    public $action;
    public $dataId;
    public $customer;
    public $name;
    public $address;
    public $phone_number;
    public $identity_number;
    public $longitude;
    public $latitude;
    public $identity_picture;
    public $location_picture;
    public $packet_tag_id;
    public $optionPacketTags;
    public $packetTags;

    protected function rules() {
        if ($this->action == 'create') {
            return [
                'customer.name' => 'required',
                'customer.address' => 'required',
                'customer.phone_number' => 'required',
                'identity_picture' => 'required',
                'location_picture' => 'required',
                'customer.longitude' => 'required',
                'customer.latitude' => 'required',
                'customer.identity_number' => 'required',
                'customer.registration_date' => 'required',
            ];
        } else {
            return [
                'customer.name' => 'required',
                'customer.address' => 'required',
                'customer.phone_number' => 'required',
                'customer.longitude' => 'required',
                'customer.latitude' => 'required',
                'customer.identity_number' => 'required',
            ];
        }
    }

    protected $messages = [
        'customer.name.required' => 'Nama tidak boleh kosong.',
        'customer.address.required' => 'Alamat tidak boleh kosong.',
        'customer.phone_number.required' => 'Nomor telepon tidak boleh kosong.',
        'identity_picture.required' => 'Foto KTP tidak boleh kosong.',
        'location_picture.required' => 'Foto Rumah tidak boleh kosong.',
        'customer.longitude.required' => 'Longitude tidak boleh kosong.',
        'customer.latitude.required' => 'Latitude tidak boleh kosong.',
        'customer.identity_number.required' => 'NIK tidak boleh kosong.',
    ];

    public function mount()
    {
        $this->customer['packet_tag_id'] = 1;
        $this->packetTags = [1];
        $this->optionPacketTags = eloquent_to_options(PacketTag::get(), 'id', 'title');

        if ($this->dataId!=''){

            $c = Customer::findOrFail($this->dataId);

            $this->customer=[
                'name'=>$c->name,
                'address'=>$c->address,
                'phone_number'=>$c->phone_number,
                'identity_picture'=>$c->identity_picture,
                'location_picture'=>$c->location_picture,
                'longitude'=>$c->longitude,
                'latitude'=>$c->latitude,
                'identity_number'=>$c->identity_number,
                'packet_tag_id'=>$c->packet_tag_id,
            ];

        }
    }

    public function create()
    {
        $this->validate();

        $this->customer['identity_picture'] = md5(rand()).'.'.$this->identity_picture->getClientOriginalExtension();
        $this->identity_picture->storeAs('public/img/identity_picture/', $this->customer['identity_picture']);

        $this->customer['location_picture'] = md5(rand()).'.'.$this->location_picture->getClientOriginalExtension();
        $this->location_picture->storeAs('public/img/location_picture/', $this->customer['location_picture']);

        $this->customer['packet_tag_id'] = (int)$this->customer['packet_tag_id'];

        $this->customer['user_id'] = Auth::id();

//        dd($this->customer);
        Customer::create($this->customer);

        $this->emit('swal:alert', [
            'type'    => 'success',
            'title'   => 'Data berhasil masuk',
            'timeout' => 3000,
            'icon'=>'success'
        ]);
        $this->emit('redirect');
    }

    public function update() {

        $this->validate();
        Customer::find($this->dataId)->update($this->customer);

        $this->emit('swal:alert', [
            'type'    => 'success',
            'title'   => 'Data berhasil update',
            'timeout' => 3000,
            'icon'=>'success'
        ]);
        $this->emit('redirect');
    }

    public function render()
    {
        return view('livewire.customer-form');
    }
}
