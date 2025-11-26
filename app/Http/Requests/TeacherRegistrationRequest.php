<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email|max:255',
            'subjects' => 'required|array|min:1',
            'subjects.*' => 'required|string|max:255',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'subjects.required' => 'Please select at least one subject.',
            'subjects.min' => 'Please select at least one subject.',
        ];
    }

    /**
     * Get the validated data for teacher creation.
     *
     * @return array<string, mixed>
     */
    public function getTeacherData(): array
    {
        return [
            'first_name' => $this->validated()['first_name'],
            'last_name' => $this->validated()['last_name'],
            'email' => $this->validated()['email'],
            'subjects' => $this->validated()['subjects'],
        ];
    }
}
