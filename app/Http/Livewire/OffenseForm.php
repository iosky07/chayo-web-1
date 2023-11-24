<?php

namespace App\Http\Livewire;

use App\Models\Offense;
use Livewire\Component;

class OffenseForm extends Component
{
    public $action;
    public $offense;
    public $dataId;

    public function render()
    {
        return view('livewire.offense-form');
    }

    public function mount()
    {
        if ($this->dataId!=''){
            $m = Offense::findOrFail($this->dataId);
            $this->student=[
                'title'=>$m->title,
                'minus_point'=>$m->minus_point,
            ];
        }
    }

    public function create()
    {
        Offense::create($this->offense);

        $this->emit('swal:alert', [
            'type'    => 'success',
            'title'   => 'Data berhasil masuk',
            'timeout' => 3000,
            'icon'=>'success'
        ]);
        $this->emit('redirect');
    }

    public function update() {

        Offense::find($this->dataId)->update($this->offense);

        $this->emit('swal:alert', [
            'type'    => 'success',
            'title'   => 'Data berhasil update',
            'timeout' => 3000,
            'icon'=>'success'
        ]);
        $this->emit('redirect');
    }

}
