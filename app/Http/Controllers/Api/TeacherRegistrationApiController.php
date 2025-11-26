<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherRegistrationApiController extends Controller
{
    /**
     * Handle API registration request.
     */
    public function register(Request $request): JsonResponse
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
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $teacher = Teacher::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'subjects' => $request->subjects,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Registration successful!',
                'data' => [
                    'id' => $teacher->id,
                    'first_name' => $teacher->first_name,
                    'last_name' => $teacher->last_name,
                    'email' => $teacher->email,
                    'subjects' => $teacher->subjects,
                ],
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred during registration. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }
}

