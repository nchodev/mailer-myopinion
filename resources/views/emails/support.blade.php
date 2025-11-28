<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Email – Support</title>
    <style>
        body { font-family: Arial, sans-serif; background:#eef2f7; margin:0; padding:0; }
        .container { max-width:600px; margin:20px auto; background:white; border-radius:10px; overflow:hidden; }
        .header { background:#0EA5E9; color:white; padding:20px; text-align:center; font-size:20px; }
        .content { padding:24px; color:#333; font-size:15px; line-height:1.6; }
        .ticket-box { background:#f0f9ff; padding:15px; border-left:4px solid #0EA5E9; border-radius:6px; }
        .footer { padding:15px; text-align:center; font-size:12px; color:#777; background:#fafafa; }
    </style>
</head>
<body>
<div class="container">

    <div class="header">Support MyOpinion</div>

    <div class="content">
        <p>Bonjour,</p>

        <p>Votre équipe support a reçu un nouveau ticket :</p>

        <div class="ticket-box">
            <strong>Nom :</strong> {{ $data['name'] }}<br><br>
            <strong>Détail du message :</strong><br>
            {!! $data['message'] !!}
        </div>

        <p style="margin-top:20px;">
            Notre équipe vous répondra dans les meilleurs délais.
        </p>

        <p>Cordialement,<br>Support MyOpinion</p>
    </div>

    <div class="footer">
        © {{ date('Y') }} MyOpinion – Assistance & Support
    </div>

</div>
</body>
</html>
