<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class WorkerController extends Controller
{
    /**
     * Display worker list
     */
    public function workerList()
    {
        $workers = Worker::with('user')->latest()->paginate(10);
        return view('admin.worker.list', compact('workers'));
    }

    /**
     * Show form for creating or editing worker
     */
    public function form($id = null)
    {
        $skillsList = [
            'Carpenter','Electrician','Plumber','Mason','Painter',
            'Welder','Driver','Labor','Gardener','Cleaner',
            'Security Guard','Cook','Other'
        ];

        if ($id) {
            $worker = Worker::with('user')->findOrFail($id);
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
            'last_name'  => 'required|string|max:255',

            // User fields
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|string|max:20',
            // 'password' => 'required|min:6',

            // Worker fields
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

        // ✅ Create User
        $user = User::create([
            'name'     => $request->first_name . ' ' . $request->last_name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make('Test@123'),
        ]);

        // ✅ Prepare Worker Data
        $data = $request->except([
            'profile_image','document_path','skills',
            'email','phone','password'
        ]);

        $data['user_id'] = $user->id;

        // Skills handling
        $skills = $request->input('skills', []);
        if (in_array('Other', $skills)) {
            $skills = array_diff($skills, ['Other']);
            $data['other_skill'] = $request->input('other_skill');
        }
        $data['skills'] = !empty($skills) ? json_encode($skills) : null;

        // Profile Image
        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')
                ->store('workers/profile', 'public');
        }

        // Document Upload
        if ($request->hasFile('document_path')) {
            $data['document_path'] = $request->file('document_path')
                ->store('workers/documents', 'public');
        }

        // ✅ Create Worker
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
        $user   = User::findOrFail($worker->user_id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',

            // User fields
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',

            // Worker fields
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

        // ✅ Update User
        $user->update([
            'name'  => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        $data = $request->except([
            'profile_image','document_path','skills','email','phone'
        ]);

        // Skills handling
        $skills = $request->input('skills', []);
        if (in_array('Other', $skills)) {
            $skills = array_diff($skills, ['Other']);
            $data['other_skill'] = $request->input('other_skill');
        } else {
            $data['other_skill'] = null;
        }
        $data['skills'] = !empty($skills) ? json_encode($skills) : null;

        // Profile Image
        if ($request->hasFile('profile_image')) {
            if ($worker->profile_image) {
                Storage::disk('public')->delete($worker->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')
                ->store('workers/profile', 'public');
        }

        // Document
        if ($request->hasFile('document_path')) {
            if ($worker->document_path) {
                Storage::disk('public')->delete($worker->document_path);
            }
            $data['document_path'] = $request->file('document_path')
                ->store('workers/documents', 'public');
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
        $worker = Worker::with('user')->findOrFail($id);
        return view('admin.worker.show', compact('worker'));
    }

    /**
     * Remove the specified worker
     */
    public function destroy($id)
    {
        $worker = Worker::findOrFail($id);

        // Delete files
        if ($worker->profile_image) {
            Storage::disk('public')->delete($worker->profile_image);
        }

        if ($worker->document_path) {
            Storage::disk('public')->delete($worker->document_path);
        }

        // Delete related user
        if ($worker->user_id) {
            User::where('id', $worker->user_id)->delete();
        }

        $worker->delete();

        return redirect()->route('worker.list')
            ->with('success', 'Worker deleted successfully.');
    }
}