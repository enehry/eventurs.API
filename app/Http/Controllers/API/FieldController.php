<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(string $id, Request $request)
    {
        $validate = $request->validate([
            'question' => 'required|string|max:255',
            'type' => 'required|string|in:short_answer,long_answer,number,dropdown,scale',
            'options' => 'nullable|array',
            'index' => 'nullable|numeric',
        ]);
        //
        $field = new Field();
        $field->question = $validate['question'];
        $field->type = $validate['type'];
        $field->options = $validate['options'] ?? null;
        $field->index = $validate['index'] ?? null;
        $field->form_id = $id;

        $field->save();

        return response()->json([
            'message' => 'Field successfully created',
            'field' => $field
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate request
        $validate = $request->validate([
            'question' => 'required|string|max:255',
            'type' => 'required|string|in:short_answer,long_answer,number,dropdown,scale',
            'options' => 'nullable|array',
            'index' => 'nullable|numeric',
        ]);

        // find field
        $field = Field::findOrFail($id);

        // update field
        $field->question = $validate['question'];
        $field->type = $validate['type'];
        $field->options = $validate['options'] ?? null;
        $field->index = $validate['index'] ?? null;

        $field->save();

        return response()->json([
            'message' => 'Field successfully updated',
            'field' => $field
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $field = Field::findOrFail($id);

        $field->delete();

        return response()->json([
            'message' => 'Field successfully deleted',
        ]);
    }
}
