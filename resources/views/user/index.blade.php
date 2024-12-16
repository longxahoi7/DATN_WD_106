<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gentle Manor')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('imagePro/image/logo/logoremove-white.png') }}" type="image/png">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

    @stack('styles')
    <style>
        *:focus {
            outline: none !important;
            box-shadow: none !important;
        }

        button:focus,
        input:focus,
        textarea:focus,
        a:focus {
            outline: none !important;
            box-shadow: none !important;
        }

        body {
            font-family: 'Roboto', sans-serif;
            font-smooth: always;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        html,
        body {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
            font-size: 16px;
            line-height: 1.6;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 700;
        }

        p {
            font-weight: 400;
        }
    </style>

</head>

<body>
    <header>
        @include('user.components.header')
    </header>

@if(session('alert'))
    <div class="alert alert-success" id="alert" role="alert">
        {{ session('alert') }}
        <br>
        {{ session('alert_2') }}
    </div>
@endif

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

    @stack('scripts')
</body>
<script>
    window.onload = function() {
        var alertElement = document.getElementById('alert','alert_2');
        if (alertElement) {
            // Sau 2 giây (2000ms), ẩn đi thông báo alert
            setTimeout(function() {
                alertElement.style.display = 'none';
            }, 2000); // 2000 milliseconds = 2 seconds
        }
    }

</script>

</html>