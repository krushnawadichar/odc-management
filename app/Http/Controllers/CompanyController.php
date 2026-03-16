<?php
// app/Http/Controllers/CompanyController.php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of companies.
     */
    public function companyList(Request $request)
    {
        $query = Company::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('registration_number', 'like', "%{$search}%")
                  ->orWhere('contact_person_name', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $companies = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        
        return view('admin.companies.list', compact('companies'));
    }

    /**
     * Show the form for creating a new company.
     */
    public function create()
    {
        $countries = Country::orderBy('name')->get();
        $states = State::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        return view('admin.companies.create', compact('countries', 'states', 'cities'));
    }

    /**
     * Store a newly created company.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'registration_number' => 'nullable|string|max:100|unique:companies',
            'email' => 'required|email|max:255|unique:companies',
            'phone' => 'nullable|string|max:20',
            'founded_year' => 'nullable|integer|min:1800|max:' . date('Y'),
            
            'contact_person_name' => 'required|string|max:255',
            'contact_person_designation' => 'nullable|string|max:100',
            'contact_person_email' => 'required|email|max:255',
            'contact_person_phone' => 'required|string|max:20',
            
            'address' => 'required|string',
            'country' => 'required|integer|exists:countries,id',
            'state' => 'required|integer|exists:states,id',
            'city' => 'required|integer|exists:cities,id',
            'postal_code' => 'required|string|max:20',
            
            'document_name' => 'nullable|string|max:255',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            
            'status' => 'required|in:Active,Inactive',
        ]);

        // Handle document upload
        if ($request->hasFile('document')) {
            $validated['document'] = $request->file('document')
                ->store('companies/documents', 'public');
        }

        Company::create($validated);

        return redirect()->route('company.list')
            ->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified company.
     */
    public function show($id)
    {
        $company = Company::with(['countryData', 'stateData', 'cityData'])->findOrFail($id);
        return view('admin.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified company.
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        $countries = Country::orderBy('name')->get();
        $states = State::where('country_id', $company->country)->orderBy('name')->get();
        $cities = City::where('state_id', $company->state)->orderBy('name')->get();
        
        return view('admin.companies.edit', compact('company', 'countries', 'states', 'cities'));
    }

    /**
     * Update the specified company.
     */
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'registration_number' => 'nullable|string|max:100|unique:companies,registration_number,' . $id,
            'email' => 'required|email|max:255|unique:companies,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'founded_year' => 'nullable|integer|min:1800|max:' . date('Y'),
            
            'contact_person_name' => 'required|string|max:255',
            'contact_person_designation' => 'nullable|string|max:100',
            'contact_person_email' => 'required|email|max:255',
            'contact_person_phone' => 'required|string|max:20',
            
            'address' => 'required|string',
            'country' => 'required|integer|exists:countries,id',
            'state' => 'required|integer|exists:states,id',
            'city' => 'required|integer|exists:cities,id',
            'postal_code' => 'required|string|max:20',
            
            'document_name' => 'nullable|string|max:255',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            
            'status' => 'required|in:Active,Inactive',
        ]);

        // Handle document upload
        if ($request->hasFile('document')) {
            // Delete old document
            if ($company->document) {
                Storage::disk('public')->delete($company->document);
            }
            $validated['document'] = $request->file('document')
                ->store('companies/documents', 'public');
        }

        $company->update($validated);

        return redirect()->route('company.list')
            ->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified company.
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        
        // Delete document
        if ($company->document) {
            Storage::disk('public')->delete($company->document);
        }

        $company->delete();

        return redirect()->route('company.list')
            ->with('success', 'Company deleted successfully.');
    }

    /**
     * Get states by country ID (AJAX)
     */
    public function getStates($countryId)
    {
        $states = State::where('country_id', $countryId)->orderBy('name')->get();
        return response()->json($states);
    }

    /**
     * Get cities by state ID (AJAX)
     */
    public function getCities($stateId)
    {
        $cities = City::where('state_id', $stateId)->orderBy('name')->get();
        return response()->json($cities);
    }

    /**
     * Bulk delete companies
     */
    public function bulkDelete(Request $request)
    {
        $ids = json_decode($request->company_ids, true);
        
        if (!is_array($ids) || empty($ids)) {
            return redirect()->back()->with('error', 'No companies selected.');
        }

        foreach ($ids as $id) {
            $company = Company::find($id);
            if ($company) {
                if ($company->document) {
                    Storage::disk('public')->delete($company->document);
                }
                $company->delete();
            }
        }

        return redirect()->route('company.list')
            ->with('success', count($ids) . ' companies deleted successfully.');
    }
}