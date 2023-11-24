<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Offense;

class OffenseController extends Controller
{
    public function index()
    {
        return view('pages.offense.index', [
            'off' => Offense::class
        ]);
    }

    public function create()
    {
        return view('pages.offense.create');
    }

    public function edit($id)
    {
        return view('pages.offense.edit', compact('id'));
    }
}
