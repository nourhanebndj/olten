<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Olten Admin Dashboard')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    },
                    colors: {
                        'primary-dark': '#000000',
                        /* Noir, parfait pour le logo */
                        'primary-light': '#ec1d20',
                        /* Rouge Olten */
                        'bg-light': '#f3f4f6',
                        /* Arrière-plan léger */
                        'sidebar-bg': '#1a1a1a',
                        /* Fond sombre pour sidebar */
                        'sidebar-hover': '#ec1d20',
                        /* Accent sur hover */
                    }
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- CSS Admin -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @stack('styles')
</head>

<body class="bg-bg-light font-sans flex min-h-screen">

    <!-- Sidebar -->
    @include('admin.layouts._sidebar')

    <!-- Content Wrapper -->
    <div class="content-wrapper flex-1 flex flex-col">
        <!-- Navbar -->
        @include('admin.layouts._navbar')

        <!-- Page Content -->
        <main class="container-fluid p-6 flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="p-4 mt-6 border-t border-gray-200 text-center text-sm text-gray-500">
            &copy; 2025 Olten Admin. Tous droits réservés.
        </footer>
    </div>
    <script src="{{ asset('assets/js/admin/dash.js') }}"></script>

    @stack('scripts')
</body>

</html>
