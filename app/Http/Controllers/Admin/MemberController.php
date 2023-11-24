<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Member;

class MemberController extends Controller
{
    public function index()
    {
        return view('pages.member.index', [
            'mem' => Member::class
        ]);
    }

    public function create()
    {
        return view('pages.member.create');
    }

    public function edit($id)
    {
        return view('pages.member.edit', compact('id'));
    }

}
