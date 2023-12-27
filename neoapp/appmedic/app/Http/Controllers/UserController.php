<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $user = $this->user->all();
        return $user;
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required',
            ]);

            $user = $this->user->create($validated);
            return $user;
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    // public function store(Request $request)
    // {
    //     $user = $this->user->create($request->all());
    //     return $user;
    // }

    public function show($id)
    {
        $user = $this->user->find($id);
        if ($user === null) {
            return response()->json(['message' => 'User not found.'], 404);
        }
        return $user;
    }

    public function update($id, Request $request)
    {
        $user = $this->user->find($id);
        if ($user === null) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        try {
            $validated = $request->validate([
                'email' => 'required',
                'password' => 'required|digits:6|unique:doctor',
            ]);
            $user->update($validated);
            return response()->json(['message' => 'User updated.']);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function destroy($id)
    {
        $user = $this->user->find($id);
        if ($user === null) {
            return response()->json(['message' => 'User not found.'], 404);
        }
        $user->delete($id);
        return response()->json(['message' => 'User not deleted.']);
    }
}
