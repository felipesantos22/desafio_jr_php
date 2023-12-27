<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DoctorController extends Controller
{

    private $doctor;

    public function __construct(Doctor $doctor)
    {
        $this->doctor = $doctor;
    }

    public function index()
    {
        $doctors = $this->doctor->with('consultation')->get();
        return $doctors;
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
                'crm' => 'required|digits:6|unique:doctor',
            ]);

            $doctor = $this->doctor->create($validated);
            return $doctor;
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function show($id)
    {
        $doctor = $this->doctor->find($id);
        if ($doctor === null) {
            return response()->json(['message' => 'Doctor not found.'], 404);
        }
        return $doctor;
    }

    public function update($id, Request $request)
    {
        $doctor = $this->doctor->find($id);
        if ($doctor === null) {
            return response()->json(['message' => 'Doctor not found.'], 404);
        }

        try {
            $validated = $request->validate([
                'name' => 'required',
                'crm' => 'required|digits:6|unique:doctor',
            ]);
            $doctor->update($validated);
            return response()->json(['message' => 'Doctor updated.']);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function destroy($id)
    {
        $doctor = $this->doctor->find($id);
        if ($doctor === null) {
            return response()->json(['message' => 'Doctor not found.'], 404);
        }
        $doctor->delete($id);
        return response()->json(['message' => 'Doctor not deleted.']);
    }
}
