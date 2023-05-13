<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        // find all users forms
        $forms = Form::with('fields')->where('user_id', $user->id)->get();

        return response()->json([
            'forms' => $forms
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        // the forms contains multiple fields
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date',
        ]);

        $form = Form::create([
            'name' => $validate['name'],
            'description' => $validate['description'],
            'starts_at' => $validate['starts_at'],
            'ends_at' => $validate['ends_at'] ?? null,
            'user_id' => auth()->user()->id,
        ]);


        return response()->json([
            'message' => 'Form created successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
        //
        return response()->json(
            // find the form with fields
            Form::with('fields')->find($form->id)->get()
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Form $forms)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Form $forms)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $forms)
    {
        // delete form
        $forms->delete();

        return response()->json([
            'message' => 'Form deleted successfully',
        ]);
    }
}
