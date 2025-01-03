<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('imagePro/image/logo/logoremove-white.png') }}" type="image/png">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script><!-- Thêm TinyMCE từ CDN -->
    <!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->



    <link rel="stylesheet" href="{{asset('css/admin/headerAdmin.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/admin.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/table.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/form.css')}}">
    @stack('styles')
    <style>
    *:focus {
        outline: none !important;
        box-shadow: none !important;
    }
    </style>
</head>

<body>
    <header>
        @include('admin.layoutAdmin.header-admin')
        <!-- Include file header -->
    </header>
    <main>
        @yield('content')
    </main>
    @stack('scripts')
</body>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->







</html>