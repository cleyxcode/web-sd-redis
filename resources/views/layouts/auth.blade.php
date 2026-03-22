<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'SD Negeri Warialau')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,700;0,9..144,900;1,9..144,300;1,9..144,700&family=Nunito:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary":   "#0D2340",
                        "secondary": "#0B7B8B",
                        "accent":    "#C9933A",
                        "cream":     "#FAF8F4",
                        "sand":      "#F0EBE0",
                        "background-light": "#FAF8F4",
                        "background-dark":  "#070F1C",
                    },
                    fontFamily: {
                        "display": ['"Fraunces"', "Georgia", "serif"],
                        "body":    ['"Nunito"', "system-ui", "sans-serif"],
                    },
                },
            },
        }
    </script>
    <style>
    *, *::before, *::after { box-sizing: border-box; }
    body { font-family: "Nunito", system-ui, sans-serif; }
    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-thumb { background: #C9933A; border-radius: 9999px; }
    </style>
</head>
<body class="bg-cream dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen">

@yield('content')

@stack('scripts')
</body>
</html>
