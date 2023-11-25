<!DOCTYPE html>
<html lang="en" class="notranslate" translate="no">
<head>
    <title> @yield('title')</title>
    <meta charset="utf-8">
    <meta name='csrf-token' content="{{ csrf_token() }}">
    <meta name='viewport' content='width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no' />
    <link href="https://cdn.lineicons.com/3.0/lineicons.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    @yield('css')
</head>
<body>

@yield('content')

@yield('js')
</body>
</html>
