<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Dasboard extends Controller
{
    //
    public function dashBoard(){
        return view('admin.index');
    }
}
