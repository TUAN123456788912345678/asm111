<!DOCTYPE html>
<html lang="en">

<head>

@include('Auth.Layout.header')

</head>

<body class="bg-gradient-primary">

    <div class="container">

        @yield('content')

    </div>

    @include('Auth.Layout.js')

</body>

</html>