<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <title>@yield('title', config('app.name', 'Laravel'))</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        @include('backend.layouts.partials.styles')
        @stack('styles')

    </head>

    <body data-sidebar="dark" data-layout-mode="light">
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->
        <div id="layout-wrapper">

            @include('backend.layouts.partials.header')

            @include('backend.layouts.partials.sidebar')

            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                @include('backend.layouts.partials.footer')
            </div>
        </div>
        @include('backend.layouts.partials.right-sidebar')
        @include('backend.layouts.partials.scripts')
        @stack('scripts')
    </body>
</html>
