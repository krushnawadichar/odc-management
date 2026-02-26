<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeController extends Controller
{
        public function employeList(){
        return view('admin.employe.list');
    }

    public function adminAddEmployeView(){

    return view('admin.employe.add');
    }
}
