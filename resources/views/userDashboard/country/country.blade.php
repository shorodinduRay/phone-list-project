<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <meta name="description" content="List of contacts in Phone Number List's database for contacts living in '{{ $dataId }}' which can be used for telemarketing campaigns" />
        <meta name="keywords"
            content="phone number list, mobile number list, sales leads, mobile leads, data prospect, sales crm, contact database, contact details" />

        <title>Country Search: {{ $dataId }} | Phone List</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />

        <!-- Font awesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
            integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&display=swap"
            rel="stylesheet" />

        <!-- Animate CSS -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

        <!-- SwiperJS CSS-->
        <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('/') }}/adminAsset/assets/css/style.css" />

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('/') }}adminAsset/assets/images/icons/favicon.ico" />

    </head>

    <body id="home">
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
                <!-- START NAVBAR -->
                <nav
                        class="navbar navbar--user navbar-expand-md navbar-light"
                        id="user-nav"
                >
                    <div class="container-fluid justify-content-end">
                        <a class="navbar-brand" href="{{ route('/') }}">
                            <img
                                    class="img-fluid"
                                    src="{{ asset('/') }}adminAsset/assets/images/logo.svg"
                                    alt="phone list"
                            />
                        </a>

                        <button
                                class="navbar-toggler me-auto"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent"
                                aria-controls="navbarSupportedContent"
                                aria-expanded="false"
                                aria-label="Toggle navigation"
                        >
                            <i class="bi bi-list"></i>
                        </button>
                        <div
                                class="collapse navbar-collapse justify-content-between"
                                id="navbarSupportedContent"
                        >
                            <ul class="me-auto mb-md-2 mb-lg-0 d-flex flex-row">
                                <li class="nav-item pl-4">
                                    <a class="nav-link" aria-current="page" href="{{ route('people') }}">
                                        Search
                                    </a>
                                </li>
                                <i class="bi bi-chevron-right d-flex align-items-center"></i>
                                <li class="nav-item pl-4" id="">
                                    <a class="nav-link active" aria-current="page" href="#">
                                        {{ $dataId }}
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- START SHOW ELEMENT ON CLICKING USER -->
                        <div class="user-div hide u-box-shadow-1">
                            <h4 class="px-4 pt-5">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</h4>
                            <div class="user--label mx-4">
                                <span>User</span>
                            </div>

                            <div class="user--menu">
                                <a class="user--menu-item" href="{{ route('account') }}">
                                    <i class="bi bi-gear"></i>
                                    <span>Settings</span>
                                </a>
                                <a class="user--menu-item" href="{{ route('upgrade') }}">
                                    <i class="bi bi-trophy"></i>
                                    <span>Upgrade Plan</span>
                                </a>

                                <a class="user--menu-item mb-3" href="{{ route('userLogout') }}">
                                    <i class="bi bi-power"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </div>
                        <!-- END SHOW ELEMENT ON CLICKING USER -->
                    </div>

                    <!-- START RIGHT NAV ITEMS -->
                    <div class="d-flex align-items-center nav-right__box">
                        <a class="btn btn-purple mx-4" href="{{ route('upgrade') }}"
                        >Get unlimited leads
                        </a>
                        <button type="button" class="btn">
                            <a href="#">
                                <i class="bi bi-telephone phone-btn"></i>
                            </a>
                        </button>

                        <!-- Link to Blog site -->
                        <a class="btn" href="http://help.phonelist.io/">
                            <i class="bi bi-question-circle"></i>
                        </a>

                        <button type="button" class="btn notification-btn">
                            <i class="bi bi-bell"></i>
                        </button>
                        <button
                                type="button"
                                id="userBtn"
                                class="user user-btn circle-element mx-3"
                        >

                            <p class="user-name">{{ $firstStringCharacter = substr(Auth::user()->firstName, 0, 1) }}{{ $firstStringCharacter = substr(Auth::user()->lastName, 0, 1) }}</p>
                        </button>
                    </div>
                    <!-- END RIGHT NAV ITEMS -->
                </nav>
                <!-- END NAVBAR -->

                <!-- START SHOW WHEN CLICKED ON NOTIFICATION -->
                <div
                        class="u-box-shadow-1 notification__sidebar hide animate__animated animate__fadeInRightBig"
                >
                    <div class="notification--header">
                        <div class="notification--header-title">
                            <h5>NOTIFICATIONS</h5>
                        </div>
                        <div class="notification--header-icons">
                            <div class="btn"><i class="bi bi-arrow-clockwise"></i></div>
                            <div class="btn close-btn">
                                <i class="bi bi-x-lg"></i>
                            </div>
                        </div>
                    </div>
                    <div class="notification--body"></div>
                </div>
                <!-- END SHOW WHEN CLICKED ON NOTIFICATION -->

            </header>

            <main>

                
                <!-- START SEARCH BARS -->
                <section class="section-searchbar pt-md-5 pb-md-4 py-2 mt-md-0 mt-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-6 ms-md-auto">
                                <div class="row">
                                    <form id="searchPeopleByName" action="{{ route('userSearch') }}">
                                        @csrf
                                        <div class="col-12">
                                            <input type="text" name="searchPeople" id="searchPeopleName"
                                                class="searchBar bg-white border-5 text-dark fw-normal col-md-9 col-8"
                                                placeholder="Search by Name..." autocomplete="off"/>
                                            <button type="submit" class="btn btn-purple">Apply</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="col-md-3 col-6">
                                <div class="dropdown" id="searchCountry">
                                    <input
                                            class="searchBar w-100 bg-white text-dark fw-normal"
                                            id="countryDropdown"
                                            type="text"
                                            placeholder="Search Person by Country..."
                                            data-toggle="dropdown"
                                            data-bs-toggle="dropdown"
                                    />
                                    <span class="caret"></span>

                                    <ul
                                            class="dropdown-menu w-100 bg-white text-dark fw-bold p-3"
                                            aria-labelledby="countryDropdown"
                                    >
                                        @foreach($country as $countries)
                                            <a class="dropdown-item" href="{{ route('country', ['id' => $countries->countryname]) }}">{{ $countries->countryname }} ({{ $countries->countrycode }}) </a>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- END SEARCH BARS -->
                <!-- START SECTION PEOPLE CARDS -->
                <section class="section-people-cards mt-4 mb-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card u-box-shadow-1 border-0 u-border-radius h-100 bg-light">
                                    <div class="card-body p-5">
                                        <h4 class="card-title">
                                            <div class="d-flex align-items-center">
                                                <div class="circle-element circle-element--person">
                                                    <i class="bi bi-people-fill"></i>
                                                </div>
                                                <h1 class="sub-heading">People Search per Country</h1>
                                            </div>

                                            <select
                                                    id="country"
                                                    name="country"
                                                    class="offset-md-2 col-md-4"
                                                    onchange="window.location.href=this.options[this.selectedIndex].value;"
                                            >
                                                @foreach($country as $countries)
                                                    <option value="{{ route('country', ['id' => $countries->countryname]) }}" @if ($dataId == $countries->countryname) selected  @endif >{{ $countries->countryname }} ({{ $countries->countrycode }})</option>
                                                @endforeach
                                            </select>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-md-0 mt-5">
                                <div class="card bg-transparent u-border-radius h-100">
                                    <div class="card-body d-flex align-items-center p-5 mx-lg-5">
                                        <div class="col-4 pe-lg-5 pe-4">
                                            <img src="{{ asset('/') }}adminAsset/assets/images/data.svg" class="img-fluid" alt="illustration" />
                                        </div>
                                        <div class="col-md-8">
                                            <h2 class="heading--sub mb-4">
                                                Reach your target contacts faster with Phone Number List
                                                </h1>
                                                <a href="{{ route('/phonelistUserRegister') }}" type="button" class="btn btn-grad px-4">
                                                    Sign Up For Free
                                                </a>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- END SECTION PEOPLE CARDS -->

                <!-- START SECTION MESSAGE -->
                <section class="section-message">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-0">
                                    <div class="card-body p-5 mt-5">
                                        <h2 class="card-text no-data d-none">
                                            No Person pages found for:
                                            <span class="text-secondary">A</span>
                                        </h2>
                                        <p class="card-text">
                                            @forelse ($data as $countryData)
                                                <a href="{{route('user', ['id' => $countryData->id, 'name'=>$countryData->first_name."-".$countryData->last_name]) }}" class="user-link">
                                                    {{$countryData->first_name." ".$countryData->last_name }}
                                                </a>
                                        @empty
                                            <h2 class="card-text no-data">
                                                No Person pages found for :
                                                <span class="text-secondary"> {{ $dataId }}</span>
                                            </h2>
                                            @endforelse
                                            </p>

                                            <div class="card-footer bg-transparent border-0">
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination justify-content-end">
                                                        <li class="page-item disabled">
                                                            <a class="page-link" href="#" aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                        </li>
                                                        <li class="page-item">
                                                            <div class="d-flex justify-content-center">
                                                                {!! $data->links() !!}
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- END SECTION MESSAGE -->


            </main>
        </section>

        <script defer src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
            <script defer src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
            </script>

            <script type="text/javascript">
                let route = "{{ url('/autocomplete-search') }}";
                $('#searchPeople').typeahead({
                    source: function (query, process) {
                        return $.get(route, {
                            query: query
                        }, function (data) {
                            return process(data);
                        });
                    }
                });
            </script>
            <script>
                $(document).ready(function () {
                    $('#countryDropdown').on('keyup', function () {
                        var value = $(this).val().toLowerCase();
                        $('.dropdown-menu li').filter(function () {
                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                        });
                    });
                });
            </script>
        <!-- Bootstrap JS -->
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>


        <!-- jQuery -->
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
                integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- ANIMATION JS -->
        <script defer src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        <!-- Swiper JS -->
        <script defer src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

        <!-- Custom JS -->
        <script defer src="{{ asset('/') }}/adminAsset/assets/js/typewriter.min.js"></script>
        <script defer src="{{ asset('/') }}/adminAsset/assets/js/counter.min.js"></script>
        <script defer src="{{ asset('/') }}/adminAsset/assets/js/testimonial.min.js"></script>
        <script defer src="{{ asset('/') }}/adminAsset/assets/js/navbar.min.js"></script>
        <script defer src="{{ asset('/') }}/adminAsset/assets/js/script.min.js"></script>

        <script defer src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
        </script>

        <!-- TRANSLATOR JS  -->
        <script type="text/javascript"
                src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>
        <script defer src="{{ asset('/') }}/adminAsset/assets/js/translator.min.js"></script>



        <script>
            var stateObj = { foo: "" };
            history.pushState(stateObj, "page without extension", "search/{{ $dataId}}");
            window.onpopstate = function(event) {
                if(event && event.state) {
                    location.reload();
                }
            }
        </script>

        <!-- TYPEWRITER JS -->
        <script>
            let bannerText = document.getElementById('bannerText');

            let typewriter = new Typewriter(bannerText, {
                loop: false,
                delay: 50,
                cursor: ' ',
            });

            typewriter
                .typeString('Crush your sales numbers every quarter')
                .pauseFor(1500)
                // .deleteAll()
                .start();
        </script>

        <!-- ANIMATION JS -->
        <script>
            AOS.init({
                once: true,
            });
        </script>

        <script>
            function handleName(e){
                if(e.key === "Enter"){
                    //alert("Enter was just pressed.");
                }

                return false;
            }
        </script>
        <script>
            window.onload = function(){
            //hide the preloader
                document.querySelector(".section-preloader").style.display = "none";
                document.querySelector(".section-content").classList.remove("d-none");
            }
        </script>

    </body>

</html>








