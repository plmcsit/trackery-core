<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FindController extends Controller
{
    public function index(){
        //echo "<h1>Find<h1>";
        return view('find.find');
    }
}
