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
            margin: 0 0 10px;
            line-height: 1.4;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .hero h1 {
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 12px;
        }
        .hero p {
            font-size: 15px;
            color: #e2e5e9;
            margin: 0;
        }
        .content {
            padding: 10px 6px;
            font-size: 15px;
            line-height: 1.6;
            color: #333;
        }

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
            width: 46px;
            margin: 0 8px;
            filter: none;
        }
        .phones {
            margin: 10px 0;
            font-size: 13px;
            color: #444;
        }
        .marketing-label {
            font-weight: bold;
            margin-bottom: 6px;
            display: block;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container">

    <!-- HEADER -->
    {{-- <div class="header">
        <div class="logos">
            <img src="{{ asset('assets/logo-1.jpeg') }}" alt="Logo MyOpinion">
            <img src="{{ asset('assets/logo-2.png') }}" alt="Logo Nakani">
        </div>
    </div> --}}

    <!-- HERO -->
    <div class="hero">
        <h1>Votre transformation digitale prend une nouvelle dimension</h1>
        <p>Innovation, souveraineté et performance au service de votre croissance.</p>
    </div>

    <!-- CONTENU -->
    <div class="content">
        {!! $data['message'] !!}
    </div>

    <!-- FOOTER GRIS -->
    <div class="footer">

        <div class="social-icons" style="margin-bottom: 10px;">
            <img src="{{ asset('assets/p1.png') }}" alt="play console ">
            <img src="{{ asset('assets/p2.png') }}" alt="app galery">
            <img src="{{ asset('assets/p3.png') }}" alt="app store">
        </div>

        <span class="marketing-label">Équipe marketing</span>
        <div class="phones">
            📞 +225 05 05 34 03 03<br>
            📞 +225 07 00 09 00 10
        </div>

        {{ config('app.name') }} — © {{ date('Y') }}<br>
        Propulsé par <strong>MyOpinion</strong> & <strong>Nakani</strong>
    </div>

</div>
</body>
</html>
