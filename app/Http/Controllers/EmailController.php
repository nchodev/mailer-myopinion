<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Email;

class EmailController extends Controller
{
   public function showForm()
    {
        return view('contact');
    }

   public function sendMail(Request $request)
{
    $request->validate([
        'type' => 'required|string|in:standard,prospects,marketing,support,notification',
        'name' => 'string|max:255',
        'emails' => 'required|array|max:10',
        'emails.*' => 'email',
        'message' => 'string',
    ]);

    foreach ($request->emails as $email) {
        Mail::to($email)->send(new ContactMail(
            [
                'name' => $request->name,
                'message' => $request->message
            ],
            $request->type
        ));
    }

    return back()->with('success', 'Email envoyé avec succès à '.count($request->emails).' destinataire(s) !');
}

}
