<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MyOpinion - Portail de mailing</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        /* RESET SIMPLE */
        *,::after,::before{
            box-sizing:border-box;
            border-width:0;
            border-style:solid;
            border-color:#e5e7eb
        }
        ::after,::before{--tw-content:''}
        html{
            line-height:1.5;
            -webkit-text-size-adjust:100%;
            -moz-tab-size:4;
            tab-size:4;
            font-family:Figtree, sans-serif;
            font-feature-settings:normal
        }
        body{margin:0;line-height:inherit}
        a{text-decoration:none;color:inherit}
        button{
            font-family:inherit;
            font-size:100%;
            font-weight:inherit;
            line-height:inherit;
            color:inherit;
            margin:0;
            padding:0;
            background:transparent;
            border:none;
            cursor:pointer
        }

        .flex{display:flex}
        .items-center{align-items:center}
        .justify-center{justify-content:center}
        .justify-between{justify-content:space-between}
        .mt-2{margin-top:0.5rem}
        .mt-4{margin-top:1rem}
        .mt-6{margin-top:1.5rem}
        .w-full{width:100%}
        .max-w-md{max-width:28rem}
        .mx-auto{margin-left:auto;margin-right:auto}
        .px-4{padding-left:1rem;padding-right:1rem}
        .py-6{padding-top:1.5rem;padding-bottom:1.5rem}
        .p-6{padding:1.5rem}
        .rounded-xl{border-radius:1rem}
        .rounded-full{border-radius:9999px}
        .shadow-lg{box-shadow:0 10px 25px -10px rgba(0,0,0,0.25)}
        .text-center{text-align:center}
        .text-sm{font-size:0.875rem;line-height:1.25rem}
        .text-base{font-size:1rem;line-height:1.5rem}
        .text-2xl{font-size:1.5rem;line-height:2rem}
        .font-semibold{font-weight:600}
        .font-medium{font-weight:500}
        .inline-flex{display:inline-flex}
        .min-h-screen{min-height:100vh}
        .relative{position:relative}
        .antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}
        .gap-2{gap:0.5rem}

        /* THEME VIA CSS VARIABLES */
        :root {
            --bg: #f3f4f6;
            --bg-soft: #e5e7eb;
            --bg-card: #ffffff;
            --text: #020617;
            --text-muted: #6b7280;
            --border-subtle: rgba(148,163,184,0.4);
            --accent: #ef4444;
            --accent-hover: #b91c1c;
            --toggle-bg: #e5e7eb;
            --toggle-border: #d1d5db;
        }

        body[data-theme="dark"] {
            --bg: #020617;
            --bg-soft: #020617;
            --bg-card: #020617;
            --text: #e5e7eb;
            --text-muted: #9ca3af;
            --border-subtle: rgba(148,163,184,0.3);
            --accent: #f97316;
            --accent-hover: #ea580c;
            --toggle-bg: #111827;
            --toggle-border: #1f2937;
        }

        body{
            background-color:var(--bg);
            color:var(--text);
        }

        .app-background{
            background:
                radial-gradient(circle at top left, rgba(239,68,68,0.13), transparent 55%),
                radial-gradient(circle at bottom right, rgba(59,130,246,0.18), transparent 55%),
                var(--bg-soft);
        }

        .app-card{
            background-color:var(--bg-card);
            border:1px solid var(--border-subtle);
        }

        .app-muted{color:var(--text-muted);}

        .btn-primary{
            background-color:var(--accent);
            color:#ffffff;
            padding:0.8rem 1.8rem;
            border-radius:9999px;
            font-size:0.95rem;
            font-weight:600;
        }
        .btn-primary:hover{
            background-color:var(--accent-hover);
        }

        .theme-toggle{
            background-color:var(--toggle-bg);
            border:1px solid var(--toggle-border);
            padding:0.25rem 0.75rem;
            border-radius:9999px;
            font-size:0.75rem;
            display:inline-flex;
            align-items:center;
            gap:0.35rem;
        }
    </style>
</head>
<body class="antialiased" data-theme="light">
    <div class="min-h-screen app-background flex items-center justify-center px-4 py-6">
        <div class="w-full max-w-md mx-auto app-card rounded-xl shadow-lg p-6 relative">
            <!-- Header simple -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div style="
                        width: 34px;
                        height: 34px;
                        border-radius: 30%;
                        background: conic-gradient(from 180deg, var(--accent) 0deg, #3b82f6 160deg, var(--accent) 320deg);
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        color:#fff;
                        font-weight:700;
                        font-size:0.9rem;
                        box-shadow:0 6px 16px rgba(0,0,0,0.25);
                    ">
                        MO
                    </div>
                    <div>
                        <div class="font-semibold text-base">MyOpinion</div>
                        <div class="app-muted text-xs">Portail de mailing</div>
                    </div>
                </div>

                <button id="themeToggle" class="theme-toggle">
                    <span id="themeIcon">🌞</span>
                    <span id="themeLabel">Clair</span>
                </button>
            </div>

            <!-- Contenu principal minimal -->
            <div class="mt-6 text-center">
                <h1 class="text-2xl font-semibold">Bienvenue</h1>
                <p class="app-muted text-sm mt-2">
                    Espace privé pour rédiger et envoyer les courriels de MyOpinion.
                </p>

                <div class="mt-6">
                    <a href="{{ url('/email') }}" class="btn-primary inline-flex items-center gap-2">
                        <span>Rédiger un courriel</span>
                        <span>➜</span>
                    </a>
                </div>
            </div>

            <!-- Petit texte en bas -->
            <div class="mt-6 text-center app-muted text-xs">
                © {{ date('Y') }} MyOpinion – Usage interne.
            </div>
        </div>
    </div>

    <!-- Script de gestion du thème -->
    <script>
        (function () {
            const body = document.body;
            const toggleBtn = document.getElementById('themeToggle');
            const icon = document.getElementById('themeIcon');
            const label = document.getElementById('themeLabel');

            function applyTheme(theme) {
                body.setAttribute('data-theme', theme);
                localStorage.setItem('myopinion-theme', theme);

                if (theme === 'dark') {
                    icon.textContent = '🌙';
                    label.textContent = 'Sombre';
                } else {
                    icon.textContent = '🌞';
                    label.textContent = 'Clair';
                }
            }

            const storedTheme = localStorage.getItem('myopinion-theme');
            if (storedTheme) {
                applyTheme(storedTheme);
            } else {
                const prefersDark = window.matchMedia &&
                    window.matchMedia('(prefers-color-scheme: dark)').matches;
                applyTheme(prefersDark ? 'dark' : 'light');
            }

            toggleBtn.addEventListener('click', function () {
                const current = body.getAttribute('data-theme') || 'light';
                const next = current === 'light' ? 'dark' : 'light';
                applyTheme(next);
            });
        })();
    </script>
</body>
</html>
