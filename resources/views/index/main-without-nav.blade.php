<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-preloader="enable">
<head>
    <meta charset="utf-8" />
    <title>{{ $pageTitle ?? 'Starter' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    @foreach([
        'assets/css/bootstrap.min.css',
        'assets/css/icons.min.css',
        'assets/css/app.min.css',
        'assets/css/custom.min.css',
        'assets/app/index/css/app.css',
    ] as $style)
        <link href="{{ asset($style) }}" rel="stylesheet" type="text/css" />
    @endforeach
    
    @yield("css")
    @stack("styles")
</head>

<body>
@yield("content")

@include("index.layouts.partials.vendor-scripts")
@yield("script")
@stack("scripts")

</body>

</html>
