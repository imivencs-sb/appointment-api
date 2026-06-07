<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Doctor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

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

    public function store(StoreDoctorRequest $request): JsonResponse
    {
        $doctor = Doctor::create($request->validated());

        return response()->json([
            'message' => 'Doctor created successfully.',
            'data' => $doctor,
        ], Response::HTTP_CREATED);
    }

    public function show(Doctor $doctor): JsonResponse
    {
        return response()->json([
            'data' => $doctor,
        ]);
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor): JsonResponse
    {
        $doctor->update($request->validated());

        return response()->json([
            'message' => 'Doctor updated successfully.',
            'data' => $doctor->fresh(),
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