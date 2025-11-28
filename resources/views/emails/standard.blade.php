<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Email – Standard</title>
    <style>
        body { font-family: Arial, sans-serif; background:#f4f4f4; margin:0; padding:0; }
        .container { max-width:600px; margin:20px auto; background:white; border-radius:8px; overflow:hidden; }
        .header { background:#4CAF50; color:white; padding:18px; text-align:center; font-size:20px; }
        .content { padding:24px; color:#333; font-size:15px; line-height:1.6; }
        .footer { padding:15px; text-align:center; font-size:12px; color:#777; background:#fafafa; }
    </style>
</head>
<body>
<div class="container">

    <div class="header">Message de {{ $data['name'] }}</div>

    <div class="content">
        <p>Bonjour,</p>

        <p>
            Vous avez reçu un nouveau message depuis le formulaire MyOpinion.
        </p>

        <p>
            <strong>Nom :</strong> {{ $data['name'] }}<br>
        </p>

        <p>
            <strong>Message :</strong><br>
            {!! $data['message'] !!}
        </p>

        <p>Cordialement,<br>L’équipe MyOpinion</p>
    </div>

    <div class="footer">
        © {{ date('Y') }} MyOpinion — Tous droits réservés
    </div>

</div>
</body>
</html>
