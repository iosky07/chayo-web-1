<?php


namespace App\Http\Livewire;


use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class SearchStudent extends Component
{
    use WithPagination;
    public $cari='';
    public $student;

    public function searching(){
        $this->student=Student::class;
        return Student::searchFront($this->cari)
            ->paginate(3);
    }

    public function render()
    {
        $students = $this->searching();
        return view('livewire.search-student',compact('students'));
    }

}
