<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gentle Manor')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('imagePro/image/logo/logo-remove-white.png') }}" type="image/png">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS (if exists) -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')

</head>

<body>
    <header>
        @include('user.components.header')
    </header>

    @if(Request::is('/'))
    <div class="slide-show">
        @include('user.components.slide-show')
    </div>
    @endif

    <main class="container">
        @yield('content')
    </main>

    <section>
        @include('user.components.footer')
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')
</body>

</html>