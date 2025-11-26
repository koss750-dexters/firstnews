<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRegistrationRequest;
use App\Services\TeacherRegistrationService;

class TeacherRegistrationController extends Controller
{
    /**
     * @var TeacherRegistrationService
     */
    protected $registrationService;

    /**
     * Constructor to inject the registration service.
     *
     * @param TeacherRegistrationService $registrationService
     */
    public function __construct(TeacherRegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    /**
     * Show the registration form.
     */
    public function showForm()
    {
        return view('registration');
    }

    /**
     * Handle the registration form submission.
     *
     * @param TeacherRegistrationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(TeacherRegistrationRequest $request)
    {
        try {
            $this->registrationService->register($request->getTeacherData());

            return redirect()->back()->with('success', 'Registration successful! Thank you for registering.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput();
        }
    }
}

