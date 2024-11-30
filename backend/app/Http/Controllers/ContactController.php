<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends BaseController
{
    // Lấy danh sách liên hệ
    public function index()
    {
        $contacts = Contact::all();

        return $this->sendResponse($contacts, 'Contacts retrieved successfully.');
    }

    // Tạo liên hệ mới
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'nullable|exists:users,id',
            'name' => 'nullable|string|max:150',
            'email' => 'nullable|string|email|max:150',
            'contact_content' => 'required|string', 
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }

        $contact = Contact::create($request->all());

        return $this->sendResponse($contact, 'Contact created successfully.');
    }

    // Lấy chi tiết một liên hệ
    public function show($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return $this->sendError('Contact not found.', [], 404);
        }

        return $this->sendResponse($contact, 'Contact retrieved successfully.');
    }

    // Cập nhật liên hệ
    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return $this->sendError('Contact not found.', [], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'nullable|exists:users,id',
            'name' => 'nullable|string|max:150',
            'email' => 'nullable|string|email|max:150',
            'contact_content' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }

        $contact->update($request->all());

        return $this->sendResponse($contact, 'Contact updated successfully.');
    }

    // Xóa liên hệ
    public function destroy($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return $this->sendError('Contact not found.', [], 404);
        }

        $contact->delete();

        return $this->sendResponse([], 'Contact deleted successfully.');
    }
}
