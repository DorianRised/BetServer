<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico') }}">


        <title> @yield('title') | BetterTips </title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Scripts -->
        @include('layouts.head-css')
        @stack('styles')
    </head>
    <body class="font-sans antialiased">

        <div>
            <!-- Page Heading --> 

            @include('layouts.sidebar')
          
            <div class="main-content">
                <div class="page-content" style="padding-top: 0px !important; padding-bottom: 30px !important; ">
                    <div class="container-fluid" >
                        <main>
                            @yield('content')
                        </main>
                    </div>       
                </div>      
            </div>
            <!-- Page Content -->
            @stack('scripts')

        </div>
    </body>
</html>

