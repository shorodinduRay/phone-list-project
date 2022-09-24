<!DOCTYPE html>
<html lang="en">
    <head>
        @include('user.userIncludes.css')
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
            <header></header>
            <main class="d-flex">
                <!-- START LOGIN LEFT SIDE -->
                @include('user.userIncludes.leftDesign')
                <!-- END LOGIN LEFT SIDE -->

                <!-- START LOGIN RIGHT SIDE -->
                @yield('bodyRight')
                <!-- END LOGIN RIGHT SIDE -->
            </main>
        </section>
        @include('user.userIncludes.script')
        <script>
            window.onload = function(){
             //hide the preloader
                 document.querySelector(".section-preloader").style.display = "none";
                 document.querySelector(".section-content").classList.remove("d-none");
             }
         </script>
    </body>
</html>
