<?php

namespace App\Services;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;

class TeacherRegistrationService
{
    /**
     * Register a new teacher.
     *
     * @param array<string, mixed> $data
     * @return Teacher
     * @throws \Exception
     */
    public function register(array $data): Teacher
    {
        try {
            return Teacher::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'subjects' => $data['subjects'],
            ]);
        } catch (\Exception $e) {
            \Log::error('Teacher registration failed', [
                'email' => $data['email'] ?? 'unknown',
                'error' => $e->getMessage(),
            ]);
            
            throw new \Exception('Failed to register teacher. Please try again.');
        }
    }

    /**
     * Check if email is already registered.
     *
     * @param string $email
     * @return bool
     */
    public function isEmailRegistered(string $email): bool
    {
        return Teacher::where('email', $email)->exists();
    }

    /**
     * Get all registered teachers.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllTeachers()
    {
        return Teacher::all();
    }

    /**
     * Find teacher by email.
     *
     * @param string $email
     * @return Teacher|null
     */
    public function findByEmail(string $email): ?Teacher
    {
        return Teacher::where('email', $email)->first();
    }
}

