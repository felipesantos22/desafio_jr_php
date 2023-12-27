<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ConsultationController extends Controller
{
    private $consultation;

    public function __construct(Consultation $consultation)
    {
        $this->consultation = $consultation;
    }

    public function index()
    {
        $consultation = $this->consultation->all();
        return $consultation;
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'data' => 'required',
                'sick_id' => [
                    'required',
                    Rule::exists('sick', 'id'),
                ],
                'doctor_id' => [
                    'required',
                    Rule::exists('doctor', 'id'),
                ],
            ]);

            $consultation = $this->consultation->create($validated);
            return $consultation;
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
}
