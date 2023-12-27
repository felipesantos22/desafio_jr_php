<?php

namespace App\Http\Controllers;

use App\Models\Sick;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SickController extends Controller
{
    private $sick;

    public function __construct(Sick $sick)
    {
        $this->sick = $sick;
    }

    public function index()
    {
        $sick = $this->sick->with('consultation')->get();
        return $sick;
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
                'cpf' => 'required|digits:11|unique:sick',
            ]);
            $sick = $this->sick->create($validated);
            return $sick;
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function show($id)
    {
        $sick = $this->sick->find($id);
        if ($sick === null) {
            return response()->json(['message' => 'Sick not found.'], 404);
        }
        return $sick;
    }

    public function update($id, Request $request)
    {
        $sick = $this->sick->find($id);
        if ($sick === null) {
            return response()->json(['message' => 'Sick not found.'], 404);
        }

        try {
            $validated = $request->validate([
                'name' => 'required',
                'cpf' => 'required|digits:11',
            ]);
            $sick->update($validated);
            return response()->json(['message' => 'Sick updated.']);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function destroy($id)
    {
        $sick = $this->sick->find($id);
        if ($sick === null) {
            return response()->json(['message' => 'Sick not found.'], 404);
        }
        $sick->delete($id);
        return response()->json(['message' => 'Sick not deleted.']);
    }
}
