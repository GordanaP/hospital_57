<?php

namespace App\Http\Controllers;

use App\Doctor;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __invoke(Doctor $doctor)
    {
        return view('test', compact('doctor'));
    }
}
