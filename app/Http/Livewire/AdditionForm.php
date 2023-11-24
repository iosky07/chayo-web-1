<?php

namespace App\Http\Livewire;

use App\Models\Addition;
use Livewire\Component;

class AdditionForm extends Component
{
    public $action;
    public $addition;
    public $dataId;

    public function render()
    {
//        dd($this->dataId);
        return view('livewire.addition-form');
    }

    public function mount()
    {
        if ($this->dataId!=''){
            $m = Addition::findOrFail($this->dataId);
            $this->addition=[
                'title'=>$m->title,
                'plus_point'=>$m->plus_point,
            ];
        }
    }

    public function create()
    {
        Addition::create($this->addition);

        $this->emit('swal:alert', [
            'type'    => 'success',
            'title'   => 'Data berhasil masuk',
            'timeout' => 3000,
            'icon'=>'success'
        ]);
        $this->emit('redirect');
    }

    public function update() {

        Addition::find($this->dataId)->update($this->addition);

        $this->emit('swal:alert', [
            'type'    => 'success',
            'title'   => 'Data berhasil update',
            'timeout' => 3000,
            'icon'=>'success'
        ]);
        $this->emit('redirect');
    }

}
