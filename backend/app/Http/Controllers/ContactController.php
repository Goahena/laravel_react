<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index()
    {
        $contacts = Contact::with('user')
            ->orderBy('user_id', 'asc')
            ->paginate(10);
        return response()->json($contacts);
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Bạn phải đăng nhập để thực hiện thao tác này'], 401);
        }

        $validated = $request->validate([
            'fullname' => 'required|max:150',
            'email' => 'required|email|max:150',
            'content' => 'required|max:150',
        ]);

        $validated['user_id'] = auth()->id();

        $contact = Contact::create($validated);

        return response()->json($contact, 201);
    }

    public function show($id)
    {
        $contact = Contact::with('user')->findOrFail($id);
        return response()->json($contact);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'content' => 'required',
        ]);

        $validated['user_id'] = auth()->id();

        $contact = Contact::findOrFail($id);
        $contact->update($validated);
        return response()->json($contact);
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response()->json(['message' => 'Xóa liên hệ thành công']);
    }
}
