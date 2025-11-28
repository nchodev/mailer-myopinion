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

        /* FOOTER GRIS AMÉLIORÉ */
        .footer {
            text-align: center;
            padding: 25px 20px;
            background: #f1f1f4;
            color: #555;
            font-size: 12px;
            border-radius: 0 0 12px 12px;
        }
        .footer a {
            color: #333;
        }
        .social-icons img {
            width: 26px;
            margin: 0 6px;
            filter: none;
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

    <!-- FOOTER GRIS -->
    <div class="footer">

        <div class="social-icons" style="margin-bottom: 10px;">
            <a href="#"><img src="{{ asset('assets/client-1.png') }}" alt="Client 1"></a>
            <a href="#"><img src="{{ asset('assets/client-2.png') }}" alt="Client 2"></a>
            <a href="#"><img src="{{ asset('assets/client-3.png') }}" alt="Client 3"></a>
            <a href="#"><img src="{{ asset('assets/client-4.png') }}" alt="Client 4"></a>
        </div>

        {{ config('app.name') }} — © {{ date('Y') }}<br>
        Propulsé par <strong>MyOpinion</strong> & <strong>Nakani</strong>
    </div>

</div>

</body>
</html>
