<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PatientController extends Controller
{
    public function index(): JsonResponse
    {
        $patients = Patient::query()
            ->orderBy('name')
            ->paginate(15);

        return response()->json([
            'status' => 'success',
            'message' => 'Patients retrieved successfully.',
            'data' => $patients,
        ]);
    }

    public function store(StorePatientRequest $request): JsonResponse
    {
        $patient = Patient::create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Patient created successfully.',
            'data' => $patient,
        ], Response::HTTP_CREATED);
    }

    public function show(Patient $patient): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Patient retrieved successfully.',
            'data' => $patient,
        ]);
    }

    public function update(UpdatePatientRequest $request, Patient $patient): JsonResponse
    {
        $patient->update($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Patient updated successfully.',
            'data' => $patient->fresh(),
        ]);
    }

    public function destroy(Patient $patient): JsonResponse
    {
        $patient->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Patient deleted successfully.',
        ]);
    }
}
