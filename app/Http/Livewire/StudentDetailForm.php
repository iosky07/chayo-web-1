<?php

namespace App\Http\Livewire;

use App\Models\Student;
use App\Models\StudentDetail;
use Livewire\Component;

class StudentDetailForm extends Component
{
    public $action;
    public $student_detail;
    public $dataId;

    public function mount()
    {
//        $this->searching();
        if ($this->dataId!=''){
            $m = StudentDetail::findOrFail($this->dataId);
            $this->student_detail=[
                'offense_id'=>$m->offense_id,
                'addition_id'=>$m->addition_id,
            ];
        }
    }

//    public function searching() {
////        $this->student_detail = StudentDetail::class;
////        return StudentDetail::search($this->dataId);
//        StudentDetail::search($this->dataId)
//            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
//            ->paginate($this->perPage);
//    }

    public function update() {
        StudentDetail::find($this->dataId)->update($this->student_detail);
    }

    public function render()
    {
        return view('livewire.student-detail-form');
    }
}
