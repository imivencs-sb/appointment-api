<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DoctorController extends Controller
{
    public function index(): JsonResponse
    {
        $doctors = Doctor::query()
            ->orderBy('name')
            ->paginate(15);

        return response()->json([
            'data' => $doctors,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:doctors,email'],
            'specialization' => ['required', 'string', 'max:255'],
        ]);

        $doctor = Doctor::create($validated);

        return response()->json([
            'message' => 'Doctor created successfully.',
            'data' => $doctor,
        ], 201);
    }

    public function show(Doctor $doctor): JsonResponse
    {
        return response()->json([
            'data' => $doctor,
        ]);
    }

    public function update(Request $request, Doctor $doctor): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => [
                'sometimes',
                'required',
                'email',
                'max:255',
                Rule::unique('doctors', 'email')->ignore($doctor->id),
            ],
            'specialization' => ['sometimes', 'required', 'string', 'max:255'],
        ]);

        $doctor->update($validated);

        return response()->json([
            'message' => 'Doctor updated successfully.',
            'data' => $doctor,
        ]);
    }

    public function destroy(Doctor $doctor): JsonResponse
    {
        $doctor->delete();

        return response()->json([
            'message' => 'Doctor deleted successfully.',
        ]);
    }
}