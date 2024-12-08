<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

    public function index()
    {
        $contacts = Contact::all();
        return response()->json([
            'status' => 'success',
            'data' => $contacts,
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:150',
            'email' => 'required|string|email|max:150',
            'content' => 'required|string|max:150',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $contact = Contact::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Contact created successfully.',
            'data' => $contact,
        ], 201);
    }


    public function show($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json([
                'status' => 'error',
                'message' => 'Contact not found.',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $contact,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json([
                'status' => 'error',
                'message' => 'Contact not found.',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'fullname' => 'nullable|string|max:150',
            'email' => 'nullable|string|email|max:150',
            'content' => 'nullable|string|max:150',
            'seen' => 'nullable|boolean',
            'user_id' => 'nullable|integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $contact->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Contact updated successfully.',
            'data' => $contact,
        ], 200);
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json([
                'status' => 'error',
                'message' => 'Contact not found.',
            ], 404);
        }

        $contact->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Contact deleted successfully.',
        ], 200);
    }
}
