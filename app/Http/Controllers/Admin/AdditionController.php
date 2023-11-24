<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Addition;

class AdditionController extends Controller
{
    public function index()
    {
        return view('pages.addition.index', [
            'add' => Addition::class
        ]);
    }

    public function create()
    {
        return view('pages.addition.create');
    }

    public function edit($id)
    {
        return view('pages.addition.edit', compact('id'));
    }
}
