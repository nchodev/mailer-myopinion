<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>MyOpinion – Marketing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #fafafa;
            font-family: 'Inter', Arial, sans-serif;
            color: #222;
        }
        .container {
            max-width: 640px;
            margin: auto;
            background: #ffffff;
            border-radius: 12px;
            padding: 0;
        }
        .header {
            text-align: center;
            padding: 25px 20px;
        }
        .logos img {
            height: 46px;
            margin: 0 8px;
            opacity: 0.95;
        }
        .hero {
            background: #4637CE;
            padding: 35px 25px;
            text-align: center;
            border-radius: 8px;
            color: #ffffff;
            margin: 0 0 30px;
            line-height: 1.4;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .hero h1 {
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 12px;
            color: #ffffff;
        }
        .hero p {
            font-size: 15px;
            color: #e2e5e9;
            margin: 0;
        }
        .content {
            padding: 30px 26px;
            font-size: 15px;
            line-height: 1.6;
            color: #333;
        }
        .divider {
            width: 60%;
            height: 1px;
            background: #e5e7eb;
            margin: 30px auto;
        }

        /* ➜ FOOTER MODERNE AVEC FOND */
        .footer {
            text-align: center;
            padding: 25px 20px;
            background: linear-gradient(135deg, #4637CE, #3427A5);
            color: #dbe4ff;
            font-size: 12px;
            border-radius: 0 0 12px 12px;
        }
        .footer a {
            color: #ffffff;
        }
        .social-icons img {
            width: 26px;
            margin: 0 6px;
            filter: brightness(0) invert(1); /* Icônes blanches */
        }
    </style>
</head>
<body>
<div class="container">
    <!-- HEADER -->
    <div class="header">
        <div class="logos">
            <img src="{{ asset('assets/logo-1.jpeg') }}" alt="Logo MyOpinion">
            <img src="{{ asset('assets/logo-2.png') }}" alt="Logo Nakani">
        </div>
    </div>

    <!-- HERO MARKETING -->
    <div class="hero">
        <h1>Votre solution digitale prend une nouvelle dimension</h1>
        <p>Innovation, souveraineté et performance au service de votre croissance.</p>
    </div>

    <!-- CONTENU -->
    <div class="content">
        {!! $data['message'] !!}
    </div>

    <div class="divider"></div>

    <!-- FOOTER AVEC FOND -->
    <div class="footer">

        <div class="social-icons" style="margin-bottom: 10px;">
            <a href="#"><img src="{{ asset('assets/facebook.png') }}" alt="Facebook"></a>
            <a href="#"><img src="{{ asset('assets/instagram.png') }}" alt="Instagram"></a>
            <a href="#"><img src="{{ asset('assets/linkedin.png') }}" alt="LinkedIn"></a>
            <a href="#"><img src="{{ asset('assets/twitter.png') }}" alt="Twitter"></a>
        </div>

        {{ config('app.name') }} — © {{ date('Y') }}<br>
        Propulsé par <strong>MyOpinion</strong> & <strong>Nakani</strong>
    </div>

</div>

</body>
</html>
