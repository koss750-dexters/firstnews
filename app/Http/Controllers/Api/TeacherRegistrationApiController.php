<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRegistrationRequest;
use App\Services\TeacherRegistrationService;
use Illuminate\Http\JsonResponse;

class TeacherRegistrationApiController extends Controller
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
     * Handle API registration request.
     *
     * @param TeacherRegistrationRequest $request
     * @return JsonResponse
     */
    public function register(TeacherRegistrationRequest $request): JsonResponse
    {
        try {
            $teacher = $this->registrationService->register($request->getTeacherData());

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
                'message' => $e->getMessage(),
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }
}

