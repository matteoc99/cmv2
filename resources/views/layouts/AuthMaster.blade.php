<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Condominium Manager</title>

    <!-- Compiled and minified CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="{{asset("css/main.css")}}">
    <link type="text/css" rel="stylesheet" href="{{asset("css/pricing.css")}}" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{asset("css/ribbons.css")}}" media="screen,projection"/>
    <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <script src="{{asset("js/main.js")}}"></script>

</head>
<body>
@include('components.navbar')
<main class="bg-img flex">
    @yield("content")
</main>
@include('components.footer')
@include("components.cookie_modal")

<script>
    $(document).ready(function () {
        M.updateTextFields();
    });
    M.updateTextFields();
</script>
</body>
</html>
