<?php

namespace App\Http\Controllers\Other;

use App\Events\ContactUsEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __invoke(ContactRequest $request)
    {
        event(new ContactUsEvent($request->validated()));

        return response()->json([
            'status' => 'MESSAGE_SEND',
        ]);
    }
}
