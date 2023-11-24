<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class MemberForm extends Component
{
    use WithFileUploads;
    public $action;
    public $member;
    public $dataId;
    public $thumbnail;
    public $optionDivision;
    public $optionPosition;
    public $options;

    public function render()
    {
        return view('livewire.member-form');
    }

    public function mount()
    {
//        dd($this->options);

        $this->member['division']='BPH';
//        $this->member['position']='bph';
        $this->member['user_id'] = Auth::id();

        $this->optionDivision=[
            ['value'=>'BPH','title'=>'BPH'],
            ['value'=>'KOMINFO','title'=>'KOMINFO'],
            ['value'=>'LuarDalam','title'=>'Luar Dalam'],
            ['value'=>'ADKESMA','title'=>'ADKESMA'],
            ['value'=>'PSDM','title'=>'PSDM'],
            ['value'=>'Perekonomian','title'=>'Perekonomian'],
            ['value'=>'NATKAT','title'=>'NATKAT'],
        ];


        if ($this->dataId!=''){
            $m = Member::findOrFail($this->dataId);
            $this->member=[
                'name'=>$m->name,
                'division'=>$m->division,
                'position'=>$m->position,
                'thumbnail'=>$m->thumbnail
            ];
        }
    }

    public function create()
    {
        $this->member['thumbnail'] = md5(rand()).'.'.$this->thumbnail->getClientOriginalExtension();
        $this->thumbnail->storeAs('public/img/member/', $this->member['thumbnail']);

        Member::create($this->member);

        $this->emit('swal:alert', [
            'type'    => 'success',
            'title'   => 'Data berhasil masuk',
            'timeout' => 3000,
            'icon'=>'success'
        ]);
        $this->emit('redirect');
    }

    public function update() {

        if ($this->thumbnail!=NULL) {
            $this->thumbnail->storeAs('public/img/member/', $this->member['thumbnail']);
        }
        Member::find($this->dataId)->update($this->member);

        $this->emit('swal:alert', [
            'type'    => 'success',
            'title'   => 'Data berhasil update',
            'timeout' => 3000,
            'icon'=>'success'
        ]);
        $this->emit('redirect');
    }
}
