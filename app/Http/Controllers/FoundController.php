<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoundController extends Controller
{
    public function index(){
        //echo "<h1>Found<h1>";
        return view('found.found');
    }
}
