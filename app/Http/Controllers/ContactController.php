<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Jobs\SendMailJob;
use App\Mail\ContactFormMail;
use App\Services\MailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * @param ContactRequest $request
     * @return JsonResponse
     */
    public function sendMail(ContactRequest $request): JsonResponse
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $phoneNumber = $request->input('phoneNumber');
        $message = $request->input('message');

        Mail::to($email)->queue(new ContactFormMail($name, $email, $phoneNumber, $message));

        return response()->json(['status' => 'success', 'message' => 'Sent successfully']);
    }
}
