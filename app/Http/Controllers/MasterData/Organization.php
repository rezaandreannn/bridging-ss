<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Organization extends Controller
{
    public function index()
    {
        $title = 'Organization';
        return view('pages.md.organization.index', compact('title'));
    }

    public function create()
    {
        return view();
    }
}
