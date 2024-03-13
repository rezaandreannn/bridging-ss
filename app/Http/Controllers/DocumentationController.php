<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;

    public function __construct()
    {
        $this->view = 'pages.docs.';
        $this->prefix = 'Documentation';
    }

    public function index()
    {
        return view('pages.docs.index');
    }

    public function location()
    {
        $title = $this->prefix . ' ' . 'Location';
        return view($this->view . 'location', compact('title'));
    }

    public function organization()
    {
        $title = $this->prefix . ' ' . 'Organization';
        return view($this->view . 'organization', compact('title'));
    }

    public function encounter()
    {
        $title = $this->prefix . ' ' . 'Encounter';
        return view($this->view . 'encounter', compact('title'));
    }
}
