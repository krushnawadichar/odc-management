<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function companyList(Request $request)
    {
        $query = Company::with('userData');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                  ->orWhere('registration_number', 'like', "%{$search}%")
                  ->orWhere('contact_person_name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $companies = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        
        return view('admin.companies.list', compact('companies'));
    }

    public function create()
    {
        $countries = Country::orderBy('name')->get();
        $states = State::orderBy('name')->get();
        $cities = City::orderBy('name')->get();

        return view('admin.companies.create', compact('countries', 'states', 'cities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'registration_number' => 'nullable|string|max:100|unique:companies',
            'email' => 'required|email|max:255|unique:users',
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

        if ($request->hasFile('document')) {
            $validated['document'] = $request->file('document')
                ->store('companies/documents', 'public');
        }

        // Remove fields not needed in company
        $companyData = $validated;
        unset($companyData['email'], $companyData['phone'], $companyData['company_name']);

        //  Create User FIRST
        $user = User::create([
            'name' => $validated['company_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make('Test@123'),
            'role_id' => 2,
        ]);

        //  Attach user_id to company
        $companyData['user_id'] = $user->id;

        // Create Company
        $company = Company::create($companyData);

        return redirect()->route('company.list')
            ->with('success', 'Company created successfully.');
    }

    public function show($id)
    {
        $company = Company::with(['countryData', 'stateData', 'cityData'])->findOrFail($id);
        return view('admin.companies.show', compact('company'));
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        $countries = Country::orderBy('name')->get();
        $states = State::where('country_id', $company->country)->orderBy('name')->get();
        $cities = City::where('state_id', $company->state)->orderBy('name')->get();
        
        return view('admin.companies.edit', compact('company', 'countries', 'states', 'cities'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'registration_number' => 'nullable|string|max:100|unique:companies,registration_number,' . $id,
            'email' => 'required|email|max:255|unique:users,email,' . $company->user_id,
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

        if ($request->hasFile('document')) {
            if ($company->document) {
                Storage::disk('public')->delete($company->document);
            }

            $validated['document'] = $request->file('document')
                ->store('companies/documents', 'public');
        }

        // Remove unwanted fields
        $companyData = collect($validated)->except(['email', 'phone', 'company_name'])->toArray();

        $company->update($companyData);

        //  Update linked user
        if ($company->user_id) {
            User::where('id', $company->user_id)->update([
                'name' => $validated['company_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
            ]);
        }

        return redirect()->route('company.list')
            ->with('success', 'Company updated successfully.');
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);

        if ($company->document) {
            Storage::disk('public')->delete($company->document);
        }

        $company->delete();

        return redirect()->route('company.list')
            ->with('success', 'Company deleted successfully.');
    }

    public function getStates($countryId)
    {
        return response()->json(
            State::where('country_id', $countryId)->orderBy('name')->get()
        );
    }

    public function getCities($stateId)
    {
        return response()->json(
            City::where('state_id', $stateId)->orderBy('name')->get()
        );
    }

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