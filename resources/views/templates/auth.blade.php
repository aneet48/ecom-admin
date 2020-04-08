<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')
    <title>{{env('APP_NAME')}}</title>

    @yield('styles')
</head>
<body>
    @yield('content')
    @yield('scripts')
</body>
</html>
