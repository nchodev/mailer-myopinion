<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>MyOpinion – Nouveau prospect</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            background: #f4f7fa;
            font-family: 'Inter', Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 650px;
            margin: auto;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .header {
            background: linear-gradient(135deg, #3b82f6, #0ea5e9);
            padding: 28px 20px;
            text-align: center;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: 700;
        }
        .content {
            padding: 30px 25px;
            line-height: 1.6;
            font-size: 15px;
        }
        .tagline {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 18px;
            color: #0ea5e9;
        }
        .cta {
            display: inline-block;
            margin-top: 22px;
            background: #0ea5e9;
            color: white;
            padding: 12px 22px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
        }
        .info-section {
            background: #f9fafb;
            padding: 20px;
            border-left: 4px solid #0ea5e9;
            margin-top: 25px;
            border-radius: 6px;
        }
        .footer {
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: #777;
        }
        .label { font-weight: 600; }
    </style>
</head>

<body>
    <div class="container">

        <div class="header">
            <h1>MyOpinion & NakAni</h1>
            <p style="margin:4px 0 0;font-size:14px;">Experts africains en solutions web & mobiles souveraines</p>
        </div>

        <div class="content">

            {{-- FORMULE D’APPROCHE --}}
            <p style="font-size:15px;">
                Bonjour,
            </p>

            <p class="tagline">Nous avons bien reçu votre demande.</p>

            <p><span class="label">Nom :</span> {{ $data['name'] }}</p>

            @if(isset($data['emails']) && is_array($data['emails']))
                <p><span class="label">Emails :</span><br>
                    @foreach($data['emails'] as $mail)
                        • {{ $mail }}<br>
                    @endforeach
                </p>
            @endif

            <p><span class="label">Type de demande :</span> {{ $data['mail_type'] ?? 'Prospect' }}</p>


            <div class="info-section">
                 {!! $data['message'] !!}
            </div>

            <a href="#" class="cta">Discuter avec un expert</a>
        </div>

        <div class="footer">
            {{ config('app.name') }} — &copy; {{ date('Y') }}<br>
            Solutions digitales pour l’Afrique et le monde.
        </div>

    </div>
</body>
</html>
