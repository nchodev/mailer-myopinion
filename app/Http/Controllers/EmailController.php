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

        'emails' => 'required|array|max:10',
        'emails.*' => 'email',

        'cc' => 'nullable|array|max:10',
        'cc.*' => 'nullable|email',

        'files.*' => 'nullable|file|max:5120',
        'message' => 'nullable|string',
    ]);

    // Nettoyage des CC (supprime null, "", etc.)
    $cc = collect($request->cc)
        ->filter(fn($item) => !empty($item))
        ->values()
        ->toArray();

    foreach ($request->emails as $email) {

        $mail = (new ContactMail(
                [
                    'message' => $request->message
                ],
                $request->type
            ));

        // → Ajouter CC seulement si le tableau n’est pas vide
        if (!empty($cc)) {
            $mail->cc($cc);
        }

        // Gérer les pièces jointes sans erreur
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $mail->attach(
                    $file->getRealPath(),
                    [
                        'as' => $file->getClientOriginalName(),
                        'mime' => $file->getMimeType(),
                    ]
                );
            }
        }

        Mail::to($email)->send($mail);
    }

    return back()->with('success', 'Email envoyé avec succès !');
}




}
