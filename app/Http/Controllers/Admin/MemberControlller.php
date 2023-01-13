<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberControlller extends Controller
{
    public function index()
    {
        return view('admin.members.index');
    }
    public function create()
    {
        return view('admin.members.create');
    }
}
