<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Olten')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/style_connecter/style_connected.css') }}">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="connected-layout">

    {{-- SIDEBAR --}}
    @include('components.sidebar_connected')

    <div class="main-content">

        {{-- HEADER --}}
        @include('components.header_connected')

        {{-- CONTENU SPÉCIFIQUE --}}
        <main class="dashboard-content">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @yield('content')
        </main>

    </div>
</div>

<script src="{{ asset('assets/js/script_connected.js') }}"></script>
</body>
</html>
