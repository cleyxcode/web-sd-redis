<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'SD Negeri Warialau')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary":          "#1f3b61",
                        "accent":           "#d4af37",
                        "background-light": "#f6f7f8",
                        "background-dark":  "#14181e",
                    },
                    fontFamily: { "display": ["Inter", "sans-serif"] },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg":  "1rem",
                        "xl":  "1.5rem",
                        "full":"9999px",
                    },
                },
            },
        }
    </script>
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen">

@yield('content')

@stack('scripts')
</body>
</html>
