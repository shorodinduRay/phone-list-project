@extends('front.master')

@section('metaDescription')
    List of contacts in Phone Number List's database for names starting with {{ $dataId }} which can be used for telemarketing campaigns
@endsection

@section('title')
    People Directory: {{ $dataId }} | Phone List
@endsection

@section('main')
    <!-- START BREADCRUMB -->
    <hr class="mt-lg-0 mt-5 text-secondary" />
    <div class="container">
        <div class="row">
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('category', ['id' => 'A'])  }}">People</a></li>
                    @if($message = Session::get('message'))
                        <li class="breadcrumb-item active" aria-current="page">{{ $message }}</li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">{{ $dataId }}</li>
                    @endif
                </ol>
            </nav>
        </div>
    </div>
    <!-- END BREADCRUMB -->
    <!-- START SEARCH BARS -->
    <section class="section-searchbar pt-md-5 pb-md-4 py-2 mt-md-0 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-6 ms-md-auto">
                    <div class="row">
                        <form  action="{{ route('userSearch') }}">
                            <div class="col-12">
                                <input type="text" name="searchPeople" id="searchPeople"
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
    <section class="section-people-cards py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div
                            class="card u-box-shadow-1 border-0 u-border-radius h-100 bg-light"
                    >
                        <div class="card-body p-5">
                            <h4 class="card-title">
                                <div class="d-flex align-items-center pb-3 mb-4">
                                    <div class="circle-element circle-element--person">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                    <h1 class="sub-heading">Person Search</h1>
                                </div>
                            </h4>
                            @if($message = Session::get('message'))
                                <div>
                                    <a href="{{ route('category', ['id' => 'A'])  }}" class="dark-link">A</a>
                                    <a href="{{ route('category', ['id' => 'B'])  }}" class="dark-link">B</a>
                                    <a href="{{ route('category', ['id' => 'C'])  }}" class="dark-link">C</a>
                                    <a href="{{ route('category', ['id' => 'D'])  }}" class="dark-link">D</a>
                                    <a href="{{ route('category', ['id' => 'E'])  }}" class="dark-link">E</a>
                                    <a href="{{ route('category', ['id' => 'F'])  }}" class="dark-link">F</a>
                                    <a href="{{ route('category', ['id' => 'G'])  }}" class="dark-link">G</a>
                                    <a href="{{ route('category', ['id' => 'H'])  }}" class="dark-link">H</a>
                                    <a href="{{ route('category', ['id' => 'I'])  }}" class="dark-link">I</a>
                                    <a href="{{ route('category', ['id' => 'J'])  }}" class="dark-link">J</a>
                                    <a href="{{ route('category', ['id' => 'K'])  }}" class="dark-link">K</a>
                                    <a href="{{ route('category', ['id' => 'L'])  }}" class="dark-link">L</a>
                                    <a href="{{ route('category', ['id' => 'M'])  }}" class="dark-link">M</a>
                                    <a href="{{ route('category', ['id' => 'N'])  }}" class="dark-link">N</a>
                                    <a href="{{ route('category', ['id' => 'O'])  }}" class="dark-link">O</a>
                                    <a href="{{ route('category', ['id' => 'P'])  }}" class="dark-link">P</a>
                                    <a href="{{ route('category', ['id' => 'Q'])  }}" class="dark-link">Q</a>
                                    <a href="{{ route('category', ['id' => 'R'])  }}" class="dark-link">R</a>
                                    <a href="{{ route('category', ['id' => 'S'])  }}" class="dark-link">S</a>
                                    <a href="{{ route('category', ['id' => 'T'])  }}" class="dark-link">T</a>
                                    <a href="{{ route('category', ['id' => 'U'])  }}" class="dark-link">U</a>
                                    <a href="{{ route('category', ['id' => 'V'])  }}" class="dark-link">V</a>
                                    <a href="{{ route('category', ['id' => 'W'])  }}" class="dark-link">W</a>
                                    <a href="{{ route('category', ['id' => 'X'])  }}" class="dark-link">X</a>
                                    <a href="{{ route('category', ['id' => 'Y'])  }}" class="dark-link">Y</a>
                                    <a href="{{ route('category', ['id' => 'Z'])  }}" class="dark-link">Z</a>
                                </div>
                            @else
                                <div>
                                    <a href="{{ route('category', ['id' => 'A'])  }}" class="dark-link @if ($dataId == 'A') active  @endif">A</a>
                                    <a href="{{ route('category', ['id' => 'B'])  }}" class="dark-link @if ($dataId == 'B') active  @endif">B</a>
                                    <a href="{{ route('category', ['id' => 'C'])  }}" class="dark-link @if ($dataId == 'C') active  @endif">C</a>
                                    <a href="{{ route('category', ['id' => 'D'])  }}" class="dark-link @if ($dataId == 'D') active  @endif">D</a>
                                    <a href="{{ route('category', ['id' => 'E'])  }}" class="dark-link @if ($dataId == 'E') active  @endif">E</a>
                                    <a href="{{ route('category', ['id' => 'F'])  }}" class="dark-link @if ($dataId == 'F') active  @endif">F</a>
                                    <a href="{{ route('category', ['id' => 'G'])  }}" class="dark-link @if ($dataId == 'G') active  @endif">G</a>
                                    <a href="{{ route('category', ['id' => 'H'])  }}" class="dark-link @if ($dataId == 'H') active  @endif">H</a>
                                    <a href="{{ route('category', ['id' => 'I'])  }}" class="dark-link @if ($dataId == 'I') active  @endif">I</a>
                                    <a href="{{ route('category', ['id' => 'J'])  }}" class="dark-link @if ($dataId == 'J') active  @endif">J</a>
                                    <a href="{{ route('category', ['id' => 'K'])  }}" class="dark-link @if ($dataId == 'K') active  @endif">K</a>
                                    <a href="{{ route('category', ['id' => 'L'])  }}" class="dark-link @if ($dataId == 'L') active  @endif">L</a>
                                    <a href="{{ route('category', ['id' => 'M'])  }}" class="dark-link @if ($dataId == 'M') active  @endif">M</a>
                                    <a href="{{ route('category', ['id' => 'N'])  }}" class="dark-link @if ($dataId == 'N') active  @endif">N</a>
                                    <a href="{{ route('category', ['id' => 'O'])  }}" class="dark-link @if ($dataId == 'O') active  @endif">O</a>
                                    <a href="{{ route('category', ['id' => 'P'])  }}" class="dark-link @if ($dataId == 'P') active  @endif">P</a>
                                    <a href="{{ route('category', ['id' => 'Q'])  }}" class="dark-link @if ($dataId == 'Q') active  @endif">Q</a>
                                    <a href="{{ route('category', ['id' => 'R'])  }}" class="dark-link @if ($dataId == 'R') active  @endif">R</a>
                                    <a href="{{ route('category', ['id' => 'S'])  }}" class="dark-link @if ($dataId == 'S') active  @endif">S</a>
                                    <a href="{{ route('category', ['id' => 'T'])  }}" class="dark-link @if ($dataId == 'T') active  @endif">T</a>
                                    <a href="{{ route('category', ['id' => 'U'])  }}" class="dark-link @if ($dataId == 'U') active  @endif">U</a>
                                    <a href="{{ route('category', ['id' => 'V'])  }}" class="dark-link @if ($dataId == 'V') active  @endif">V</a>
                                    <a href="{{ route('category', ['id' => 'W'])  }}" class="dark-link @if ($dataId == 'W') active  @endif">W</a>
                                    <a href="{{ route('category', ['id' => 'X'])  }}" class="dark-link @if ($dataId == 'X') active  @endif">X</a>
                                    <a href="{{ route('category', ['id' => 'Y'])  }}" class="dark-link @if ($dataId == 'Y') active  @endif">Y</a>
                                    <a href="{{ route('category', ['id' => 'Z'])  }}" class="dark-link @if ($dataId == 'Z') active  @endif">Z</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-md-0 mt-5">
                    <div class="card bg-transparent u-border-radius h-100">
                        <div class="card-body d-flex align-items-center px-5 mx-5">
                            <div class="col-md-4 px-4 mx-3">
                                <img
                                        src="{{ asset('/') }}/adminAsset/assets/images/data.svg"
                                        class="img-fluid"
                                        alt="illustration"
                                />
                            </div>
                            <div class="col-md-8">
                    <span class="heading--sub mb-4">
                      Reach your target contacts faster with Phone Number List
                    </span>
                                @guest
                                    <a
                                            href="{{ route('/phonelistUserRegister') }}"
                                            type="button"
                                            class="btn btn-grad px-4 mt-3"
                                    >
                                        Sign Up For Free
                                    </a>
                                @else
                                    <a
                                            href="{{ route('people') }}"
                                            type="button"
                                            class="btn btn-grad px-4 mt-3"
                                    >
                                        Sign Up For Free
                                    </a>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION PEOPLE CARDS -->

    <!-- START SECTION MESSAGE -->
    <section class="section-message py-5 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0">
                        <div class="card-body p-5">
                            {{-- @if($message = Session::get('message'))
                                <span class="card-text no-data">
                                   {{ $message }}
                                </span>
                            @else --}}
                                <h2 class="card-text text-dark fw-bold fst-normal fs-3">
                                    Person Directory:
                                    <span class="text-dark fw-bold fst-normal">{{ $dataId }}</span>
                                </h2>
                                <p class="card-text">
                                    @forelse ($data as $allData)
                                        <a href="{{ route('user', ['id' => $allData->id, 'name'=>$allData->first_name."-".$allData->last_name]) }}" class="user-link"
                                        >{{$allData->first_name." ".$allData->last_name }}</a>
                                    @empty
                                    <h2 class="card-text no-data">
                                        No Person pages found for:
                                        <span class="text-secondary">{{ $dataId }}</span>
                                    </h2>
                                    @endforelse
                                    </p>
                                    <div class="card-footer bg-transparent border-0">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-end">
                                                <li class="page-item">
                                                    <div class="d-flex justify-content-center">
                                                        {!! $data->links() !!}
                                                    </div>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </p>
                            {{-- @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION MESSAGE -->

    <script  src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
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
@endsection

{{--<script>
    function handleName(e){
        if(e.key === "Enter"){
            alert("Enter was just pressed.");
        }

        return false;
    }
</script>--}}

