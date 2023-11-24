<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class StudentForm extends Component
{
    use WithFileUploads;
    public $action;
    public $student;
    public $dataId;
    public $thumbnail;
    public $optionStudy;

    public function render()
    {
        return view('livewire.student-form');
    }

    public function mount()
    {
        $this->student['study_program']='Sistem Informasi';

        $this->optionStudy=[
            ['value'=>'Sistem Informasi','title'=>'Sistem Informasi'],
            ['value'=>'Teknologi Informasi','title'=>'Teknologi Informasi'],
            ['value'=>'Informatika','title'=>'Informatika'],
        ];

        if ($this->dataId!=''){
            $m = Student::findOrFail($this->dataId);
            $this->student=[
                'name'=>$m->name,
                'nim'=>$m->nim,
                'study_program'=>$m->study_program,
                'entry_year'=>$m->entry_year,
                'category'=>$m->category,
                'point'=>$m->point,
            ];
        }
    }

    public function create()
    {
//        dd($this->student);
        Student::create($this->student);

        $this->emit('swal:alert', [
            'type'    => 'success',
            'title'   => 'Data berhasil masuk',
            'timeout' => 3000,
            'icon'=>'success'
        ]);
        $this->emit('redirect');
    }

    public function update() {

        Student::find($this->dataId)->update($this->student);

        $this->emit('swal:alert', [
            'type'    => 'success',
            'title'   => 'Data berhasil update',
            'timeout' => 3000,
            'icon'=>'success'
        ]);
        $this->emit('redirect');
    }
}
