<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'سحابداری')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap & استایل‌های پروژه -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-iconpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/category-advanced.css') }}">
    <link rel="stylesheet" href="{{ asset('css/category-form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/person-create.css') }}">
    @yield('head')
</head>
<body>
    <div class="wrapper">
        @yield('content')
    </div>
    <!-- اسکریپت‌های مورد نیاز اگر داشتی -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @yield('scripts')
</body>
</html>
