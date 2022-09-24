<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        @include('admin.includes.css')
        <title>@yield('title')</title>

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

            <section class="section-dashboard">
                <!-- START SIDEBAR -->
                @include('admin.includes.navbar')
                <!-- END SIDEBAR -->

                <!-- START MAIN BODY -->
                @yield('body')
                <!-- END MAIN BODY -->
            </section>
        </section>
        @include('admin.includes.script')
        @stack('custom_js')
        <script>
            window.onload = function(){
             //hide the preloader
                 document.querySelector(".section-preloader").style.display = "none";
                 document.querySelector(".section-content").classList.remove("d-none");
             }
         </script>

    </body>

</html>
