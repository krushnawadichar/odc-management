<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OdcService;
use App\Models\Company;
use App\Models\Work;
use App\Models\ContractRequest;

class WorkController extends Controller
{
    protected $service;

    public function __construct(OdcService $service)
    {
        $this->service = $service;
    }

    public function workList()
    {
        $work = Work::with('company.userData')
            ->latest()
            ->paginate(10);

        return view('admin.works.list', compact('work'));
    }

    public function createWork()
    {
        $companies = Company::with('userData')
            ->where('status', 'Active')
            ->get();

        return view('admin.works.create', compact('companies'));
    }

    public function workStore(Request $request)
    {
        $request->validate([
            'company_id'      => 'required',
            'work_title'      => 'required|max:255',
            'no_of_workers'   => 'nullable|integer',
            'work_type'       => 'nullable|string',
            'experience'      => 'nullable|string',
            'salary_per_day'  => 'nullable|numeric',
            'location'        => 'nullable|string',
            'start_date'      => 'nullable|date',
            'end_date'        => 'nullable|date',
            'skills'          => 'nullable|string',
            'description'     => 'nullable|string',
            'status'          => 'required',
        ]);

        Work::create($request->all());

        return redirect()
            ->route('work.list')
            ->with('success', 'Work created successfully.');
    }

    public function editWork($id)
    {
        $work = Work::findOrFail($id);

        $companies = Company::with('userData')
            ->where('status', 'Active')
            ->get();

        return view(
            'admin.works.create',
            compact('work', 'companies')
        );
    }

    public function updateWork(Request $request, $id)
    {
        $work = Work::findOrFail($id);

        $request->validate([
            'company_id'      => 'required',
            'work_title'      => 'required|max:255',
            'no_of_workers'   => 'nullable|integer',
            'work_type'       => 'nullable|string',
            'experience'      => 'nullable|string',
            'salary_per_day'  => 'nullable|numeric',
            'location'        => 'nullable|string',
            'start_date'      => 'nullable|date',
            'end_date'        => 'nullable|date',
            'skills'          => 'nullable|string',
            'description'     => 'nullable|string',
            'status'          => 'required',
        ]);

        $work->update($request->all());

        return redirect()
            ->route('work.list')
            ->with('success', 'Work updated successfully.');
    }

    public function deleteWork($id)
    {
        $work = Work::findOrFail($id);

        $work->delete();

        return redirect()
            ->route('work.list')
            ->with('success', 'Work deleted successfully.');
    }

    public function showWork($id)
    {
        $work = Work::with('company.userData')
            ->findOrFail($id);

        return view('admin.works.show', compact('work'));
    }      

}

