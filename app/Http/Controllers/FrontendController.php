<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\OdcManpower;
use App\Services\OdcService;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    protected $service;

    public function __construct(OdcService $service)
    {
        $this->service = $service;
    }

    /* Home Page */
    public function home()
    {
        $companies = Company::latest()->take(5)->get();
        $manpowers = OdcManpower::where('status','available')
                        ->latest()
                        ->take(5)
                        ->get();

        return view('home', compact('companies','manpowers'));
    }

    /* Show Forms */
    public function showManpowerForm()
    {
        return view('manpower.register');
    }

    public function showCompanyForm()
    {
        return view('company.register');
    }

    /* Store Data */
    public function registerManpower(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'skills' => 'nullable|string',
            'available_date' => 'required|date',
        ]);

        $this->service->registerManpower($request->only([
            'name','phone','skills','available_date'
        ]));

        return redirect()->route('home')
            ->with('success','Manpower Registered Successfully');
    }

    public function registerCompany(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'phone' => 'required',
            'required_date' => 'required|date',
            'required_manpower' => 'required|integer|min:1',
        ]);

        $this->service->registerCompany($request->only([
            'company_name','contact_person','phone',
            'required_date','required_manpower'
        ]));

        return redirect()->route('home')
            ->with('success','Company Registered Successfully');
    }
}

