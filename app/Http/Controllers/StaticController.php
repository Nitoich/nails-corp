<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class StaticController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        return View::make('app');
    }

    public function api_documentation(): \Illuminate\Contracts\View\View
    {
        return View::make('documentation', ['requests' => config('api_doc')]);
    }
}
