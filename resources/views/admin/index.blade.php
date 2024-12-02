<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    @stack('styles')
</head>

<body>
    <header>
        @include('admin.layoutAdmin.header-admin') <!-- Include file header -->
    </header>
    <section>
        @include('admin.layoutAdmin.navbar-admin') <!-- Include file header -->
    </section>
    <main>
        @yield('content') ;
    </main>
    @stack('scripts')
</body>


</html>