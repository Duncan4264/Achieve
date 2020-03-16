<html lang = "en">
<head>@yield('title')</head>

<body>
@include('layout.header')
<div align="center">
     @yield('content')
</div>
@include('layout.footer')
</body>

</html>