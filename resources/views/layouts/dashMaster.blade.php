<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="U6usp-PTw_g4g8yjdQhKgl0AV2USIIBT9YmkTceiyHQ" />

    <title>Condominium Manager</title>

    <!-- Compiled and minified CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="{{asset("css/main.css")}}">
    <link rel="stylesheet" href="{{asset("css/chat.css")}}">
    <link type="text/css" rel="stylesheet" href="{{asset("css/pricing.css")}}" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{asset("css/ribbons.css")}}" media="screen,projection"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.Default.css"/>

    <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
    <script src="{{asset("js/main.js")}}"></script>
    <script src="{{asset("js/chat.js")}}"></script>
    <script src="{{asset("js/dragndrop.js")}}"></script>
    @livewireStyles

</head>
<body>
@include('components.dashNav')
<main>
    @auth
        @include("components.fab")
    @endauth
    @yield("content")
    @auth

        @if(\Illuminate\Support\Facades\Auth::user()->isCraftsman())
            @include("components.modals.addTicketModal")
        @endif

        @include("components.modals.upgradeCallModal")

    @endauth
        @include("components.cookie_modal")

</main>
@livewireScripts

</body>
</html>
