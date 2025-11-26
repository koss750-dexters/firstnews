<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherRegistrationController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showForm()
    {
        return view('registration');
    }

    /**
     * Handle the registration form submission.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email|max:255',
            'subjects' => 'required|array|min:1',
            'subjects.*' => 'required|string|max:255',
        ], [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'subjects.required' => 'Please select at least one subject.',
            'subjects.min' => 'Please select at least one subject.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Teacher::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'subjects' => $request->subjects,
            ]);

            return redirect()->back()->with('success', 'Registration successful! Thank you for registering.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'An error occurred during registration. Please try again.'])
                ->withInput();
        }
    }
}

