<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkerController extends Controller
{
    /**
     * Display worker list
     */
    public function workerList()
    {
        $workers = Worker::latest()->paginate(10);
        return view('admin.worker.list', compact('workers'));
    }

    /**
     * Show form for creating or editing worker
     */
    public function form($id = null)
    {
        // Predefined skills list
        $skillsList = [
            'Carpenter',
            'Electrician',
            'Plumber',
            'Mason',
            'Painter',
            'Welder',
            'Driver',
            'Labor',
            'Gardener',
            'Cleaner',
            'Security Guard',
            'Cook',
            'Other'
        ];

        if ($id) {
            $worker = Worker::findOrFail($id);
            return view('admin.worker.add', compact('worker', 'skillsList'));
        }
        
        return view('admin.worker.add', compact('skillsList'));
    }

    /**
     * Store a newly created worker
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:workers',
            'phone' => 'required|string|max:20',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'skills' => 'nullable|array',
            'skills.*' => 'string',
            'other_skill' => 'nullable|string|max:255',
            'registration_date' => 'required|date',
            'employment_type' => 'nullable|in:Full-Time,Part-Time,Contract,Intern',
            'salary_per_day' => 'nullable|numeric|min:0',
            'status' => 'required|in:Active,Inactive',
            'address' => 'nullable|string',
            'highest_education' => 'nullable|string|max:255',
            'work_duration' => 'nullable|string|max:100',
            'document_name' => 'nullable|string|max:255',
            'document_path' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120', // 5MB max
        ]);

        $data = $request->except(['profile_image', 'document_path', 'skills']);

        // Handle skills - remove 'Other' from array if present and store other_skill separately
        $skills = $request->input('skills', []);
        if (in_array('Other', $skills)) {
            $skills = array_diff($skills, ['Other']);
            $data['other_skill'] = $request->input('other_skill');
        }
        $data['skills'] = !empty($skills) ? json_encode($skills) : null;

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('workers/profile', 'public');
            $data['profile_image'] = $imagePath;
        }

        // Handle document upload
        if ($request->hasFile('document_path')) {
            $documentPath = $request->file('document_path')->store('workers/documents', 'public');
            $data['document_path'] = $documentPath;
        }

        Worker::create($data);

        return redirect()->route('worker.list')
            ->with('success', 'Worker created successfully.');
    }

    /**
     * Update the specified worker
     */
    public function update(Request $request, $id)
    {
        $worker = Worker::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:workers,email,' . $worker->id,
            'phone' => 'required|string|max:20',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'skills' => 'nullable|array',
            'skills.*' => 'string',
            'other_skill' => 'nullable|string|max:255',
            'registration_date' => 'required|date',
            'employment_type' => 'nullable|in:Full-Time,Part-Time,Contract,Intern',
            'salary_per_day' => 'nullable|numeric|min:0',
            'status' => 'required|in:Active,Inactive',
            'address' => 'nullable|string',
            'highest_education' => 'nullable|string|max:255',
            'work_duration' => 'nullable|string|max:100',
            'document_name' => 'nullable|string|max:255',
            'document_path' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);

        $data = $request->except(['profile_image', 'document_path', 'skills']);

        // Handle skills
        $skills = $request->input('skills', []);
        if (in_array('Other', $skills)) {
            $skills = array_diff($skills, ['Other']);
            $data['other_skill'] = $request->input('other_skill');
        } else {
            $data['other_skill'] = null;
        }
        $data['skills'] = !empty($skills) ? json_encode($skills) : null;

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image
            if ($worker->profile_image) {
                Storage::disk('public')->delete($worker->profile_image);
            }
            
            $imagePath = $request->file('profile_image')->store('workers/profile', 'public');
            $data['profile_image'] = $imagePath;
        }

        // Handle document upload
        if ($request->hasFile('document_path')) {
            // Delete old document
            if ($worker->document_path) {
                Storage::disk('public')->delete($worker->document_path);
            }
            
            $documentPath = $request->file('document_path')->store('workers/documents', 'public');
            $data['document_path'] = $documentPath;
        }

        $worker->update($data);

        return redirect()->route('worker.list')
            ->with('success', 'Worker updated successfully.');
    }

    /**
     * Display the specified worker
     */
    public function show($id)
    {
        $worker = Worker::findOrFail($id);
        return view('admin.worker.show', compact('worker'));
    }

    /**
     * Remove the specified worker
     */
    public function destroy($id)
    {
        $worker = Worker::findOrFail($id);
        
        // Delete profile image if exists
        if ($worker->profile_image) {
            Storage::disk('public')->delete($worker->profile_image);
        }
        
        // Delete document if exists
        if ($worker->document_path) {
            Storage::disk('public')->delete($worker->document_path);
        }

        $worker->delete();

        return redirect()->route('worker.list')
            ->with('success', 'Worker deleted successfully.');
    }
}