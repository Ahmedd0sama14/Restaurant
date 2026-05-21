<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store(ContactRequest $request)
    {
        $data= $request->validated();
        Contact::create($data);
        return response()->json([
            'message' => 'Thanks your message has been sent ',
            'data' => $data
        ], 201);

    }

}
