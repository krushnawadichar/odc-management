<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OdcService;
use App\Models\ContractRequest;

class AdminController extends Controller
{
    protected $service;

    public function __construct(OdcService $service)
    {
        $this->service = $service;
    }

    public function dashboard()
    {
        $requests = ContractRequest::with(['manpower','company'])
                    ->latest()
                    ->get();

        return view('admin.dashboard',compact('requests'));
    }

    public function approve($id)
    {
        $this->service->approveRequest($id);

        return back()->with('success','Request Approved');
    }
}

