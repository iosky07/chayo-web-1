<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('pages.student.index', [
            'stud' => Student::class
        ]);
    }

    public function create()
    {
        return view('pages.student.create');
    }

    public function edit($id)
    {
        return view('pages.student.edit', compact('id'));
    }
}
