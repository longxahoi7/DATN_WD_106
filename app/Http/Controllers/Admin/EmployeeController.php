<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    public function listEmployee(){
return view('admin.pages.account.employee.list');
    }
    public function createEmployee(){
        return view('admin.pages.account.employee.create');
            }
    
}
