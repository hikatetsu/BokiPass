<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function index()
    {
        return view('timeline.index');
    }

    public function showCreateForm()
    {
        return view('timeline.create');
    }

    public function create()
    {
        return view('timeline.index');
    }
}
