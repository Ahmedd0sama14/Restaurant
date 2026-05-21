<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(5);
        return view('contacts.index', compact('contacts'));
    }
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return to_route('contacts')->with('success', 'Message deleted .');
    }


}
