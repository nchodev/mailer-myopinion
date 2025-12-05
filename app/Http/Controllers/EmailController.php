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
        'subject' => 'required|string',
        'emails' => 'required|array',
        'emails.*' => 'email',
        'cc' => 'nullable|array',
        'cc.*' => 'nullable|email',
        'bcc' => 'nullable|array',
        'bcc.*' => 'nullable|email',
        'files.*' => 'nullable|file',
        'message' => 'nullable|string',
    ]);

    $cc = collect($request->cc)->filter(fn($item) => !empty($item))->values()->toArray();
    $bcc = collect($request->bcc)->filter(fn($item) => !empty($item))->values()->toArray();

    foreach ($request->emails as $email) {
        $mail = new ContactMail([
            'subject' => $request->subject,
            'message' => $request->message
        ], $request->type);

        if (!empty($cc)) $mail->cc($cc);
        if (!empty($bcc)) $mail->bcc($bcc);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $mail->attach($file->getRealPath(), [
                    'as' => $file->getClientOriginalName(),
                    'mime' => $file->getMimeType(),
                ]);
            }
        }

        Mail::to($email)->send($mail);
    }

    return back()->with('success', 'Email envoyé avec succès à ' . count($request->emails) . ' destinataires.');
}





}
