<?php

namespace App\Http\Controllers;

class LandingController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pek Second'
        ];
        return view('landing', $data);
    }
}
