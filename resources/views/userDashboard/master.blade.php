<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="description" content="" />
        <meta
            name="keywords"
            content="phone number list, mobile number list, sales leads, mobile leads, data prospect, sales crm, contact database, contact details"
        />

        <title>@yield('title')</title>

        @include('userDashboard.includes.css')
    </head>

    <body>
         <!-- START PRELOADER -->
         <section class="section-preloader">
            <div class="preloader" id="preloaders">
            <div class="preloader__square"></div>
            <div class="preloader__square"></div>
            <div class="preloader__square"></div>
            <div class="preloader__square"></div>
            </div>
        </section>
        <!-- END PRELOADER -->
        <section class="section-content d-none">
            <header>
                @include('userDashboard.includes.header')
            </header>

            <main id="peopleData">
                @yield('body')
            </main>
        </section>

        @include('userDashboard.includes.script')
        <script>
            window.onload = function(){
             //hide the preloader
                 document.querySelector(".section-preloader").style.display = "none";
                 document.querySelector(".section-content").classList.remove("d-none");
             }
         </script>
    </body>
</html>

