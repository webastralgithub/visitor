
<!DOCTYPE html>
    <html>
        <head>
            <title>@yield('title')</title>
            @include('layouts.head')
        </head>
    <body>
        <section class="contaner--section" >
            <div class="navbar--section">@include('layouts.agencySideNav')</div>
            <div class="content--section">
                <div>@include('layouts.header')</div>
                <main>@yield('content')</main>
            </div>    
        </section>
        <div>@include('layouts.footer')</div>
    </body>
</html>


