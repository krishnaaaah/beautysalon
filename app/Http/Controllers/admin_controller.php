<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class admin_controller extends Controller
{
    public function load_view()
    {
        return view('services.index',compact('services'));
    }
}
