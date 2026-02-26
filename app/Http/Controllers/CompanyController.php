<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function companyList(){
        return view('admin.company.list');
    }
}
