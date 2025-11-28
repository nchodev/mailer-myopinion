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
            padding: 20px;
            color: white;
            text-align: center;
        }
        .header-logos {
            width: 100%;
            text-align: center;
            margin-bottom: 12px;
        }
        .header-logos img {
            height: 50px;
            margin: 0 10px;
        }
        .content {
            padding: 30px 25px;
            line-height: 1.6;
            font-size: 15px;
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
        .social-icons img {
            width: 28px;
            margin: 0 6px;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- HEADER AVEC DEUX LOGOS -->
        <div class="header">

            <div class="header-logos">
                <img src="{{ asset('assets/logo-1.jpeg') }}" alt="Logo MyOpinion">
                <img src="{{ asset('assets/logo-2.png') }}" alt="Logo Nakani">
            </div>

            <h1 style="margin: 0;">MyOpinion & NakAni</h1>
            <p style="margin:4px 0 0;font-size:14px;">Experts africains en solutions web & mobiles souveraines</p>
        </div>

        <!-- CONTENU DU MAIL -->
        <div class="content">
            <div class="info-section">
                {!! $data['message'] !!}
            </div>
        </div>

        <!-- FOOTER + ICÔNES RÉSEAUX -->
        <div class="footer">

            <div class="social-icons" style="margin-bottom: 10px;">
                <a href="#" target="_blank">
                    <img src="{{ asset('assets/facebook.png') }}" alt="Facebook">
                </a>
                <a href="#" target="_blank">
                    <img src="{{ asset('assets/instagram.png') }}" alt="Instagram">
                </a>
                <a href="#" target="_blank">
                    <img src="{{ asset('assets/linkedin.png') }}" alt="LinkedIn">
                </a>
                <a href="#" target="_blank">
                    <img src="{{ asset('assets/twitter.png') }}" alt="Twitter">
                </a>
            </div>

            {{ config('app.name') }} — &copy; {{ date('Y') }}<br>
            Solutions digitales pour l’Afrique et le monde.
        </div>

    </div>
</body>
</html>
