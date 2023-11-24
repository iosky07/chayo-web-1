<?php

namespace App\Http\Livewire;

use App\Models\PacketTag;
use Livewire\Component;

class PacketTagForm extends Component
{
    public $action;
    public $dataId;
    public $title;
    public $packetTag;

    protected $rules = [
      'packetTag.title' => 'required'
    ];

    protected $messages = [
        'packetTag.title.required' => 'Nama paket tidak boleh kosong.'
    ];

    public function mount()
    {
        if ($this->dataId!=''){
            $pt = PacketTag::findOrFail($this->dataId);
            $this->packetTag=[
                'title'=>$pt->title,
            ];
        }
    }

    public function create()
    {
        $this->validate();
        PacketTag::create($this->packetTag);

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
        PacketTag::find($this->dataId)->update($this->packetTag);

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
        return view('livewire.packet-tag-form');
    }
}
