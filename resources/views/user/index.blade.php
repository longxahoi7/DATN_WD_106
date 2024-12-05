<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @stack('styles')
</head>

<body>
    <header>
        @include('user.components.header')
        <!-- Include file header -->
    </header>
    @if(Request::is('/'))
        <div class="slide-show">
            @include('user.components.slide-show')
        </div>
    @endif
    <main>
        @yield('content') 
    </main>
    <section>
        @include('user.components.footer')
        <!-- Include file header -->
    </section>

    @stack('scripts')
</body>


</html>