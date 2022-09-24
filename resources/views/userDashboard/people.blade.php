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

        <title>You | Phone List</title>

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
                <section class="section-user-dashboard">

                    <!-- START SIDEBAR -->
                    <section class="section-user-dashboard--sidebar">
                        
                        <div class="heading--sub py-3 ps-4 u-border-bottom">Filters</div>
                
                        <form id="search" action="{{ route('people.search.combination') }}">
                
                            <!-- INPUT NAME -->
                            <div class="input-name u-border-bottom py-3 px-4">
                                <div class="input-title pb-2">
                                    <i class="bi bi-person-badge pe-2"></i>
                                    Name
                                </div>
                                @if(isset($name))
                                    <input
                                            type="text"
                                            id='nameInput'
                                            name="name"
                                            onkeypress="handle()"
                                            placeholder="Enter name..."
                                            autocomplete="off"
                                            value="{{ $name }}"
                                    />
                                @else
                                    <input
                                            type="text"
                                            id='nameInput'
                                            name="name"
                                            onkeypress="handle()"
                                            placeholder="Enter name..."
                                            autocomplete="off"
                                    />
                                @endif
                
                                <button type="submit" onclick="nameSubmitButton()" class="btn btn-purple rounded-1 w-100 submitBtn">
                                    Apply
                                </button>
                
                
                
                            </div>
                            
                            <!-- INPUT CURRENT ADDRESS -->
                            <div class="input-currentAdd u-border-bottom py-3 px-4">
                                <div class="input-title pb-2">
                                    <i class="bi bi-pin-map-fill"></i>
                                    Current Address
                                </div>
                
                                @if(isset($location))
                                    <input
                                            type="text"
                                            name="location"
                                            id="locationInput"
                                            placeholder="Enter current address..."
                                            onkeypress="handleLocation()"
                                            autocomplete="off"
                                            value="{{ $location }}"
                                    />
                                @else
                                    <input
                                            type="text"
                                            name="location"
                                            id="locationInput"
                                            placeholder="Enter current address..."
                                            onkeypress="handleLocation()"
                                            autocomplete="off"
                                    />
                                @endif
                                <button type="submit"  class="btn btn-purple rounded-1 w-100 submitBtn">
                                    Apply
                                </button>
                            </div>
                
                            <!-- INPUT HOMETOWN -->
                            <div class="input-hometown u-border-bottom py-3 px-4">
                                <div class="input-title pb-2">
                                    <i class="bi bi-house-door-fill"></i>
                                    Hometown
                                </div>
                                @if(isset($hometown))
                                    <input
                                            type="text"
                                            name="hometown"
                                            id="hometownInput"
                                            placeholder="Enter hometown..."
                                            onkeypress="handleHometown()"
                                            autocomplete="off"
                                            value="{{ $hometown }}"
                                    />
                                @else
                                    <input
                                            type="text"
                                            name="hometown"
                                            id="hometownInput"
                                            placeholder="Enter hometown..."
                                            onkeypress="handleHometown()"
                                            autocomplete="off"
                                    />
                                @endif
                                <button type="submit" class="btn btn-purple rounded-1 w-100 submitBtn">
                                    Apply
                                </button>
                            </div>
                
                            <!-- INPUT COUNTRY -->
                            <div class="input-country u-border-bottom py-3 px-4">
                                <div class="input-title pb-2">
                                    <i class="bi bi-globe2 pe-2"></i>
                                    Country
                                </div>
                                <div class="dropdown" id="searchCountry">
                                    @if (isset($countries))
                                        <input
                                                class="searchBar col-12"
                                                id="countryInput"
                                                type="text"
                                                name="country"
                                                placeholder="Search by Country..."
                                                data-toggle="dropdown"
                                                data-bs-toggle="dropdown"
                                                autocomplete="off"
                                                value="{{ $countries }}"
                                        />
                                    @else ()
                                        <input
                                                class="searchBar col-12"
                                                id="countryInput"
                                                type="text"
                                                name="country"
                                                placeholder="Search by Country..."
                                                data-toggle="dropdown"
                                                data-bs-toggle="dropdown"
                                                autocomplete="off"
                                        />
                
                
                                    @endif
                                    <span class="caret"></span>
                
                                    <ul class="dropdown-menu p-3" aria-labelledby="countryDropdown">
                                        @foreach($country as $countryName)
                                            <button  class="dropdown-item submitBtn" id="countryBtn{{ $countryName->id }}"
                                                    type="submit" onclick="getCountryName({{ $countryName->id }})"
                                                    value="{{ $countryName->countryname }}" >{{ $countryName->countryname }}
                                                ({{ $countryName->countrycode }})
                                            </button>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                
                            <!-- INPUT BIRTHYEAR -->
                            <div class="input-age u-border-bottom py-3 px-4">
                                <div class="input-title pb-2">
                                    <i class="bi bi-person-lines-fill pe-2"></i>
                                    Birthyear
                                </div>
                                @if (isset($age))
                                    <input
                                            type="text"
                                            id='ageInput'
                                            name="age"
                                            onkeypress="handle()"
                                            placeholder="Enter birthyear..."
                                            autocomplete="off"
                                            value="{{ $age }}"
                                    />
                                @else
                                    <input
                                            type="text"
                                            id='ageInput'
                                            name="age"
                                            onkeypress="handle()"
                                            placeholder="Enter birthyear..."
                                            autocomplete="off"
                                    />
                                @endif
                                <button type="submit" class="btn btn-purple rounded-1 w-100 submitBtn">
                                    Apply
                                </button>
                            </div>
                            <!--INPUT GENDER-->
                            <div class="input-gender u-border-bottom py-3 px-4">
                                <div class="input-title pb-2">
                                    <i class="bi bi-gender-ambiguous pe-2"></i>
                                    Gender
                                </div>
                                <div class="dropdown" id="searchGender">
                                    @if (isset($gender))
                                        <input
                                                class="searchBar text-dark fw-normal col-12"
                                                id="genderInput"
                                                type="text"
                                                placeholder="Search by gender..."
                                                data-toggle="dropdown"
                                                data-bs-toggle="dropdown"
                                                autocomplete="off"
                                                name="gender"
                                                value="{{ $gender }}"
                                        />
                                    @else
                                        <input
                                                class="searchBar text-dark fw-normal col-12"
                                                id="genderInput"
                                                type="text"
                                                placeholder="Search by gender..."
                                                data-toggle="dropdown"
                                                data-bs-toggle="dropdown"
                                                autocomplete="off"
                                                name="gender"
                                        />
                                    @endif
                
                                    <ul
                                            class="dropdown-menu bg-white text-dark fw-bold p-3"
                                            aria-labelledby="genderDropdown"
                                    >
                                        <li class="dropdown-item">
                                            <button class="maleBtn submitBtn" type="submit" value="male">
                                                Male
                                            </button>
                                        </li>
                                        <li class="dropdown-item">
                                            <button class="femaleBtn submitBtn" type="submit" value="female">
                                                Female
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                
                            <!-- INPUT RELATIONSHIP STATUS -->
                            <div class="input-relationship-status py-3 px-4">
                                <div class="input-title pb-2">
                                    <i class="bi bi-heart-fill pe-2"></i>
                                    Relationship Status
                                </div>
                                <div class="dropdown" id="searchRelationship">
                                    @if (isset($relationship_status))
                                        <input
                                                class="searchBar text-dark fw-normal col-12"
                                                id="relationshipInput"
                                                type="text"
                                                placeholder="Search by relationship..."
                                                data-toggle="dropdown"
                                                data-bs-toggle="dropdown"
                                                autocomplete="off"
                                                name="relationship_status"
                                                value="{{ $relationship_status }}"
                                        />
                                    @else
                                        <input
                                                class="searchBar text-dark fw-normal col-12"
                                                id="relationshipInput"
                                                type="text"
                                                placeholder="Search by relationship..."
                                                data-toggle="dropdown"
                                                data-bs-toggle="dropdown"
                                                autocomplete="off"
                                                name="relationship_status"
                                        />
                                    @endif
                
                
                                    <ul
                                            class="dropdown-menu bg-white text-dark fw-bold p-3"
                                            aria-labelledby="genderDropdown"
                                    >
                                        <li class="dropdown-item">
                                            <button class="singleBtn" type="submit" value="single">
                                                Single
                                            </button>
                                        </li>
                                        <li class="dropdown-item">
                                            <button
                                                    class="relationBtn submitBtn"
                                                    type="submit"
                                                    value="in a relationship"
                                            >
                                                In a relationship
                                            </button>
                                        </li>
                                        <li class="dropdown-item">
                                            <button class="engagedBtn submitBtn" type="submit" value="engaged">
                                                Engaged
                                            </button>
                                        </li>
                                        <li class="dropdown-item">
                                            <button class="marriedBtn submitBtn" type="submit" value="married">
                                                Married
                                            </button>
                                        </li>
                                        <li class="dropdown-item">
                                            <button
                                                    class="openBtn submitBtn"
                                                    type="submit"
                                                    value="in an open relationship"
                                            >
                                                In an open relationship
                                            </button>
                                        </li>
                                        <li class="dropdown-item">
                                            <button
                                                    class="complicatedBtn submitBtn"
                                                    type="submit"
                                                    value="it's complicated"
                                            >
                                                It's complicated
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                
                        </form>
                    </section>
                    <!-- END SIDEBAR -->
                
                    @if(isset($allData)!= null)
                            <!-- START MAIN DASHBOARD -->
                                <section class="section-user-dashboard--main">
                                    <div class="container">
                                        <div class="row">
                                            <!-- START TABLE -->
                                            <div
                                                    class="section-table table-scrollable my-5 mb-2 ms-4"
                                                    style="width: 100vw; overflow: auto; max-height: 90vh"
                                            >
                                                <div class="container">
                                                    <div class="row">
                                                        <table
                                                                class="table table-hover table-bordered table-responsive list"
                                                                id="peopleTable"
                                                        >
                                                            <form action="{{ route('customExport') }}" enctype="multipart/form-data" method="get">
                                                                @csrf
                                                                <thead>
                                                                <tr>
                                                                    @if(isset($name))<input type="text"  name="name" value="{{ $name }}" hidden />@endif
                                                                    @if(isset($location)) <input type="text" name="location" value="{{ $location }}" hidden />@endif
                                                                    @if(isset($hometown)) <input type="text" name="hometown" value="{{ $hometown }}" hidden />@endif
                                                                    @if (isset($countries)) <input type="text"name="country" value="{{ $countries }}" hidden />@endif
                                                                    @if (isset($age)) <input type="text" id='ageInput' name="age" value="{{ $age }}" hidden />@endif
                                                                    @if (isset($gender))<input type="text" name="gender" value="{{ $gender }}" hidden />@endif
                                                                    @if (isset($relationship_status)) <input type="text" name="relationship_status" value="{{ $relationship_status }}" hidden />@endif
                                                                    <th class="px-4">
                                                                        <input id="checkAll" type="button" class="selectAll" value="Select All"/>
                                                                        <div class="dropdown open">
                                                                            <button
                                                                                    class="btn btn-purple dropdown-toggle rounded"
                                                                                    type="button"
                                                                                    id="triggerId"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-haspopup="true"
                                                                                    aria-expanded="false"
                                                                            >
                                                                                Download Filtered Data
                                                                            </button>
                                                                            <div
                                                                                    class="dropdown-menu"
                                                                                    aria-labelledby="triggerId"
                                                                            >
                                                                                <button type="submit" class="dropdown-item select">
                                                                                    Download All Filtered Data
                                                                                </button>
                                                                                <hr>
                                                                                <span class="dropdown-item select">Download
                                                                                <input name="limit" class="select-input" type="number" />
                                                                                Datas
                                                                                </span>
                                                                                <button class="btn btn-purple mx-auto" type="submit">
                                                                                    Apply Download
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </th>
                                                                    <th>Name</th>
                                                                    <th>Age</th>
                                                                    <th>Work Place</th>
                                                                    <th>Country</th>
                                                                    <th>Quick Actions</th>
                                                                    <th>Gender</th>
                                                                    <th>Relationship Status</th>
                                                                    <th>Last Education Year</th>
                                                                    <th>Current Address</th>
                                                                    <th>Home Town</th>
                                                                </tr>
                                                                </thead>
                                                            </form>
                                                            <form action="{{ route('download-data') }}" enctype="multipart/form-data" method="get">
                                                                <tbody id="tbody">
                                                                @foreach($allData as $data)
                                                                    <tr class="table-row">
                                                                        <td>
                                                                            <input type="checkbox" name="chk[]" id="chk" class="form-check-input" value="{{$data->id}}" >
                                                                        </td>
                                                                        <td>
                                                                            <a href="{{ route('people.user', ['id' => $data->id ]) }}" class="person-name">
                                                                                {{ ucwords($data->first_name.' '.$data->last_name) }}
                                                                            </a>
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty( $data->age ))
                                                                                {{ $data->age }}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty( $data->work ))
                                                                                {{ ucwords($data->work)}}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty( $data->country ))
                                                                            <a href="{{ route('search.country', ['id' => $data->country]) }}" class="country-name">
                                                                                {{ ucwords($data->country) }}
                                                                            </a>
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </td>
                                                                        <td class="position-relative">
                                                                            <button
                                                                                    type="button"
                                                                                    class="btn btn-access btn-access--phone"
                                                                                    id="{{ $data->id }}"
                                                                                    onclick="accessPhoneNumber({{ $data->id }})"
                                                                            >
                                                                                Access Phone Number
                                                                            </button>
                                                                            <div class="message-box hide-text">
                                                                                Verified number costs one credit.
                                                                            </div>
                
                                                                            <div class="button-group hide" id="buttonGroup{{ $data->id }}">
                                                                                <a
                                                                                        class="btn btn-access btn-access--phone"
                                                                                        href=""
                                                                                >
                                                                                    <i class="bi bi-phone"></i>
                                                                                    <i class="bi bi-caret-down-fill"></i>
                                                                                </a>
                                                                                <div
                                                                                        class="message-box message-box--phone hide-text"
                                                                                        id="messagePhone{{ $data->id }}"
                                                                                >
                                                                                </div>
                
                                                                                <a
                                                                                        class="btn btn-access btn-access--email"
                                                                                        href=""
                                                                                >
                                                                                    <i class="bi bi-envelope"></i>
                                                                                    <i class="bi bi-caret-down-fill"></i>
                                                                                </a>
                
                                                                                <div
                                                                                        class="message-box message-box--email hide-text"
                                                                                        id="messageEmail{{ $data->id }}"
                                                                                >
                                                                                    <!-- Email not available -->
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($data->gender))
                                                                                {{ ucwords($data->gender)}}
                                                                            @else
                                                                                -
                                                                            @endif</td>
                                                                        <td>
                                                                            @if(!empty( $data->relationship_status ))
                                                                                {{ ucwords($data->relationship_status) }}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty( $data->education_last_year ))
                                                                                {{ $data->education_last_year}}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty( $data->location ))
                                                                                {{ ucwords($data->location) }}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                            @if(!empty( $data->location_city ))
                                                                                , {{  ucwords($data->location_city) }}
                                                                            @endif
                                                                            @if(!empty( $data->location_state ))
                                                                                , {{  ucwords($data->location_state) }}
                                                                            @endif
                                                                            @if(!empty( $data->location_region ))
                                                                                , {{  ucwords($data->location_region) }}
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty( $data->hometown ))
                                                                                {{ ucwords($data->hometown) }}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                            @if(!empty( $data->hometown_city ))
                                                                                , {{  ucwords($data->hometown_city) }}
                                                                            @endif
                                                                            @if(!empty( $data->hometown_state ))
                                                                                , {{  ucwords($data->hometown_state) }}
                                                                            @endif
                                                                            @if(!empty( $data->hometown_region ))
                                                                                , {{  ucwords($data->hometown_region) }}
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>  
                                                        </table>
                                                        @if(isset($message))
                                                            <span>{{ $message }}</span>
                                                        @endif
                                                        <!-- END TABLE -->
                
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END TABLE -->
                                    <!-- Download CSV Button -->
                                    <div class="container">
                                        <div class="row py-4">
                                            @if(isset($count))
                                                <div class="col-md-4 text-secondary ps-5">
                                                    Filtered records: {{ $count }}
                                                </div>
                                            @else
                                                <div class="col-md-4 text-secondary ps-5">
                                                </div>
                                            @endif
                                            <div class="col-md-8 ms-auto d-flex justify-content-end">
                                                <button
                                                        type="submit"
                                                        class="btn btn-download border-3"
                                                        disabled="disabled"
                                                >
                                                    <i class="bi bi-download"></i>
                                                    &nbsp;&nbsp; Download Selected Data
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- START PAGINATION -->
                                    <div class="row pb-2">
                                        <nav aria-label="Page navigation example" >
                                            <ul class="pagination justify-content-end">
                                                <li class="page-item">
                                                    <div  class="d-sm-inline-flex justify-content-center">
                                                        {!! $allData->links() !!}
                                                    </div>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <!-- END PAGINATION -->
                                </section>
                            </form>
                    @else
                            <section class="section-user-dashboard--main">
                                <div class="container">
                                    <div class="row">
                                        <!-- START TABLE -->
                                        <div
                                                class="section-table table-scrollable my-5 mb-2 ms-3"
                                                style="width: 100vw; overflow: auto; max-height: 90vh"
                                        >
                                            <div class="container">
                                                <div class="row">
                                                    <table
                                                            class="table table-hover table-bordered table-responsive list"
                                                            id="peopleTable"
                                                    >
                                                        <thead>
                                                        <tr>
                                                            <th class="px-4">
                                                                <input id="checkAll" type="button" class="selectAll" value="Select All"/>
                                                                <!--<input type="button" class="selectAll" value="Download All Filtered Data" />-->
                                                                <div class="dropdown open d-none">
                                                                    <button
                                                                            class="btn btn-purple dropdown-toggle rounded"
                                                                            type="button"
                                                                            id="triggerId"
                                                                            data-bs-toggle="dropdown"
                                                                            aria-haspopup="true"
                                                                            aria-expanded="false"
                                                                    >
                                                                        Download Filtered Data
                                                                    </button>
                                                                    <div
                                                                            class="dropdown-menu"
                                                                            aria-labelledby="triggerId"
                                                                    >
                                                                        <button type="submit" class="dropdown-item select">
                                                                            Download All Filtered Data
                                                                        </button>
                                                                        <hr>
                                                                        <span class="dropdown-item select">Download
                                                                        <input name="limit" class="select-input" type="number" />
                                                                        Datas
                                                                        </span>
                                                                        <button class="btn btn-purple mx-auto" type="submit">
                                                                            Apply Download
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <th>Name</th>
                                                            <th>Age</th>
                                                            <th>Work Place</th>
                                                            <th>Country</th>
                                                            <th>Quick Actions</th>
                                                            <th>Gender</th>
                                                            <th>Relationship Status</th>
                                                            <th>Last Education Year</th>
                                                            <th>Current Address</th>
                                                            <th>Home Town</th>
                                                        </tr>
                                                        </thead>
                                                        <form action="{{ route('download-data') }}" enctype="multipart/form-data" method="get">
                                                            <tbody id="tbody">
                                                            <tr class="table-row">
                                                                <td>
                                                                    <input type="checkbox" name="chk[]" id="chk" class="form-check-input" value="1" >
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('people.user', ['id' => 1]) }}" class="person-name">
                                                                        Hakou Bennourine
                                                                    </a>
                                                                </td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>
                                                                    <a href="{{ route('country', ['id' => 'Algeria']) }}" class="country-name">
                                                                        Algeria
                                                                    </a>
                                                                </td>
                                                                <td class="position-relative">
                                                                    <button
                                                                            type="button"
                                                                            class="btn btn-access btn-access--phone"
                                                                            id="1"
                                                                            onclick="accessPhoneNumber(1)"
                                                                    >
                                                                        Access Phone Number
                                                                    </button>
                                                                    <div class="message-box hide-text">
                                                                        Verified number costs one credit.
                                                                    </div>
                
                                                                    <div class="button-group hide" id="buttonGroup1">
                                                                        <a
                                                                                class="btn btn-access btn-access--phone"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-phone"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                                                                        <div
                                                                                class="message-box message-box--phone hide-text"
                                                                                id="messagePhone1"
                                                                        >
                                                                        </div>
                
                                                                        <a
                                                                                class="btn btn-access btn-access--email"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-envelope"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                
                                                                        <div
                                                                                class="message-box message-box--email hide-text"
                                                                                id="messageEmail1"
                                                                        >
                                                                            <!-- Email not available -->
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>Male</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr class="table-row">
                                                                <td>
                                                                    <input type="checkbox" name="chk[]" id="chk" class="form-check-input" value="2" >
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('people.user', ['id' => 2]) }}" class="person-name">
                                                                        Koukou Nirmou
                                                                    </a>
                                                                </td>
                                                                <td></td>
                                                                <td>Docteur.Dz</td>
                                                                <td>
                                                                    <a href="{{ route('country', ['id' => 'Algeria']) }}" class="country-name">
                                                                        Algeria
                                                                    </a>
                                                                </td>
                                                                <td class="position-relative">
                                                                    <button
                                                                            type="button"
                                                                            class="btn btn-access btn-access--phone"
                                                                            id="2"
                                                                            onclick="accessPhoneNumber(2)"
                                                                    >
                                                                        Access Phone Number
                                                                    </button>
                                                                    <div class="message-box hide-text">
                                                                        Verified number costs one credit.
                                                                    </div>
                
                                                                    <div class="button-group hide" id="buttonGroup2">
                                                                        <a
                                                                                class="btn btn-access btn-access--phone"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-phone"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                                                                        <div
                                                                                class="message-box message-box--phone hide-text"
                                                                                id="messagePhone2"
                                                                        >
                                                                        </div>
                
                                                                        <a
                                                                                class="btn btn-access btn-access--email"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-envelope"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                
                                                                        <div
                                                                                class="message-box message-box--email hide-text"
                                                                                id="messageEmail2"
                                                                        >
                                                                            <!-- Email not available -->
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>Male</td>
                                                                <td>Engaged</td>
                                                                <td></td>
                                                                <td>b'Paris, France'</td>
                                                                <td>b'Paris, France'</td>
                                                            </tr>
                                                            <tr class="table-row">
                                                                <td>
                                                                    <input type="checkbox" name="chk[]" id="chk" class="form-check-input" value="3" >
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('people.user', ['id' => 3]) }}" class="person-name">
                                                                        عمرعمر عمر
                                                                    </a>
                                                                </td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>
                                                                    <a href="{{ route('country', ['id' => 'Algeria']) }}" class="country-name">
                                                                        Algeria
                                                                    </a>
                                                                </td>
                                                                <td class="position-relative">
                                                                    <button
                                                                            type="button"
                                                                            class="btn btn-access btn-access--phone"
                                                                            id="3"
                                                                            onclick="accessPhoneNumber(3)"
                                                                    >
                                                                        Access Phone Number
                                                                    </button>
                                                                    <div class="message-box hide-text">
                                                                        Verified number costs one credit.
                                                                    </div>
                
                                                                    <div class="button-group hide" id="buttonGroup3">
                                                                        <a
                                                                                class="btn btn-access btn-access--phone"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-phone"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                                                                        <div
                                                                                class="message-box message-box--phone hide-text"
                                                                                id="messagePhone3"
                                                                        >
                                                                        </div>
                
                                                                        <a
                                                                                class="btn btn-access btn-access--email"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-envelope"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                
                                                                        <div
                                                                                class="message-box message-box--email hide-text"
                                                                                id="messageEmail3"
                                                                        >
                                                                            <!-- Email not available -->
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>Male</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr class="table-row">
                                                                <td>
                                                                    <input type="checkbox" name="chk[]" id="chk" class="form-check-input" value="4" >
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('people.user', ['id' => 4]) }}" class="person-name">
                                                                        Djihad Yahyawi
                                                                    </a>
                                                                </td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>
                                                                    <a href="{{ route('country', ['id' => 'Algeria']) }}" class="country-name">
                                                                        Algeria
                                                                    </a>
                                                                </td>
                                                                <td class="position-relative">
                                                                    <button
                                                                            type="button"
                                                                            class="btn btn-access btn-access--phone"
                                                                            id="4"
                                                                            onclick="accessPhoneNumber(4)"
                                                                    >
                                                                        Access Phone Number
                                                                    </button>
                                                                    <div class="message-box hide-text">
                                                                        Verified number costs one credit.
                                                                    </div>
                
                                                                    <div class="button-group hide" id="buttonGroup4">
                                                                        <a
                                                                                class="btn btn-access btn-access--phone"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-phone"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                                                                        <div
                                                                                class="message-box message-box--phone hide-text"
                                                                                id="messagePhone4"
                                                                        >
                                                                        </div>
                
                                                                        <a
                                                                                class="btn btn-access btn-access--email"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-envelope"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                
                                                                        <div
                                                                                class="message-box message-box--email hide-text"
                                                                                id="messageEmail4"
                                                                        >
                                                                            <!-- Email not available -->
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>Male</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr class="table-row">
                                                                <td>
                                                                    <input type="checkbox" name="chk[]" id="chk" class="form-check-input" value="5" >
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('people.user', ['id' => 5]) }}" class="person-name">
                                                                        Meek Assane
                                                                    </a>
                                                                </td>
                                                                <td></td>
                                                                <td>Facebook</td>
                                                                <td>
                                                                    <a href="{{ route('country', ['id' => 'Algeria']) }}" class="country-name">
                                                                        Algeria
                                                                    </a>
                                                                </td>
                                                                <td class="position-relative">
                                                                    <button
                                                                            type="button"
                                                                            class="btn btn-access btn-access--phone"
                                                                            id="5"
                                                                            onclick="accessPhoneNumber(5)"
                                                                    >
                                                                        Access Phone Number
                                                                    </button>
                                                                    <div class="message-box hide-text">
                                                                        Verified number costs one credit.
                                                                    </div>
                
                                                                    <div class="button-group hide" id="buttonGroup5">
                                                                        <a
                                                                                class="btn btn-access btn-access--phone"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-phone"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                                                                        <div
                                                                                class="message-box message-box--phone hide-text"
                                                                                id="messagePhone5"
                                                                        >
                                                                        </div>
                
                                                                        <a
                                                                                class="btn btn-access btn-access--email"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-envelope"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                
                                                                        <div
                                                                                class="message-box message-box--email hide-text"
                                                                                id="messageEmail5"
                                                                        >
                                                                            <!-- Email not available -->
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>Male</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr class="table-row">
                                                                <td>
                                                                    <input type="checkbox" name="chk[]" id="chk" class="form-check-input" value="6" >
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('people.user', ['id' => 6]) }}" class="person-name">
                                                                        Fatiha Brahimi
                                                                    </a>
                                                                </td>
                                                                <td></td>
                                                                <td>Facebook</td>
                                                                <td>
                                                                    <a href="{{ route('country', ['id' => 'Algeria']) }}" class="country-name">
                                                                        Algeria
                                                                    </a>
                                                                </td>
                                                                <td class="position-relative">
                                                                    <button
                                                                            type="button"
                                                                            class="btn btn-access btn-access--phone"
                                                                            id="6"
                                                                            onclick="accessPhoneNumber(6)"
                                                                    >
                                                                        Access Phone Number
                                                                    </button>
                                                                    <div class="message-box hide-text">
                                                                        Verified number costs one credit.
                                                                    </div>
                
                                                                    <div class="button-group hide" id="buttonGroup6">
                                                                        <a
                                                                                class="btn btn-access btn-access--phone"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-phone"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                                                                        <div
                                                                                class="message-box message-box--phone hide-text"
                                                                                id="messagePhone6"
                                                                        >
                                                                        </div>
                
                                                                        <a
                                                                                class="btn btn-access btn-access--email"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-envelope"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                
                                                                        <div
                                                                                class="message-box message-box--email hide-text"
                                                                                id="messageEmail6"
                                                                        >
                                                                            <!-- Email not available -->
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>Female</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>b'Oran, Algeria'</td>
                                                            </tr>
                                                            <tr class="table-row">
                                                                <td>
                                                                    <input type="checkbox" name="chk[]" id="chk" class="form-check-input" value="7" >
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('people.user', ['id' => 7]) }}" class="person-name">
                                                                        Dahmanus Mzabi
                                                                    </a>
                                                                </td>
                                                                <td></td>
                                                                <td>Ghardaïa</td>
                                                                <td>
                                                                    <a href="{{ route('country', ['id' => 'Algeria']) }}" class="country-name">
                                                                        Algeria
                                                                    </a>
                                                                </td>
                                                                <td class="position-relative">
                                                                    <button
                                                                            type="button"
                                                                            class="btn btn-access btn-access--phone"
                                                                            id="7"
                                                                            onclick="accessPhoneNumber(7)"
                                                                    >
                                                                        Access Phone Number
                                                                    </button>
                                                                    <div class="message-box hide-text">
                                                                        Verified number costs one credit.
                                                                    </div>
                
                                                                    <div class="button-group hide" id="buttonGroup7">
                                                                        <a
                                                                                class="btn btn-access btn-access--phone"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-phone"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                                                                        <div
                                                                                class="message-box message-box--phone hide-text"
                                                                                id="messagePhone7"
                                                                        >
                                                                        </div>
                
                                                                        <a
                                                                                class="btn btn-access btn-access--email"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-envelope"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                
                                                                        <div
                                                                                class="message-box message-box--email hide-text"
                                                                                id="messageEmail7"
                                                                        >
                                                                            <!-- Email not available -->
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>Male</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>b'Gharda\xc3\xafa'</td>
                                                                <td></td>
                                                            </tr>
                                                            <tr class="table-row">
                                                                <td>
                                                                    <input type="checkbox" name="chk[]" id="chk" class="form-check-input" value="8" >
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('people.user', ['id' => 8]) }}" class="person-name">
                                                                        Djamel Eddine Kherrour
                                                                    </a>
                                                                </td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>
                                                                    <a href="{{ route('country', ['id' => 'Algeria']) }}" class="country-name">
                                                                        Algeria
                                                                    </a>
                                                                </td>
                                                                <td class="position-relative">
                                                                    <button
                                                                            type="button"
                                                                            class="btn btn-access btn-access--phone"
                                                                            id="8"
                                                                            onclick="accessPhoneNumber(8)"
                                                                    >
                                                                        Access Phone Number
                                                                    </button>
                                                                    <div class="message-box hide-text">
                                                                        Verified number costs one credit.
                                                                    </div>
                
                                                                    <div class="button-group hide" id="buttonGroup8">
                                                                        <a
                                                                                class="btn btn-access btn-access--phone"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-phone"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                                                                        <div
                                                                                class="message-box message-box--phone hide-text"
                                                                                id="messagePhone8"
                                                                        >
                                                                        </div>
                
                                                                        <a
                                                                                class="btn btn-access btn-access--email"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-envelope"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                
                                                                        <div
                                                                                class="message-box message-box--email hide-text"
                                                                                id="messageEmail8"
                                                                        >
                                                                            <!-- Email not available -->
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>Male</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>b'Batna, Algeria'</td>
                                                            </tr>
                                                            <tr class="table-row">
                                                                <td>
                                                                    <input type="checkbox" name="chk[]" id="chk" class="form-check-input" value="9" >
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('people.user', ['id' => 9]) }}" class="person-name">
                                                                        Dalal Dallal
                                                                    </a>
                                                                </td>
                                                                <td></td>
                                                                <td>Psychologue clinicienne</td>
                                                                <td>
                                                                    <a href="{{ route('country', ['id' => 'Algeria']) }}" class="country-name">
                                                                        Algeria
                                                                    </a>
                                                                </td>
                                                                <td class="position-relative">
                                                                    <button
                                                                            type="button"
                                                                            class="btn btn-access btn-access--phone"
                                                                            id="9"
                                                                            onclick="accessPhoneNumber(9)"
                                                                    >
                                                                        Access Phone Number
                                                                    </button>
                                                                    <div class="message-box hide-text">
                                                                        Verified number costs one credit.
                                                                    </div>
                
                                                                    <div class="button-group hide" id="buttonGroup9">
                                                                        <a
                                                                                class="btn btn-access btn-access--phone"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-phone"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                                                                        <div
                                                                                class="message-box message-box--phone hide-text"
                                                                                id="messagePhone9"
                                                                        >
                                                                        </div>
                
                                                                        <a
                                                                                class="btn btn-access btn-access--email"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-envelope"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                
                                                                        <div
                                                                                class="message-box message-box--email hide-text"
                                                                                id="messageEmail9"
                                                                        >
                                                                            <!-- Email not available -->
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>Female</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>b'Algiers, Algeria'</td>
                                                            </tr>
                                                            <tr class="table-row">
                                                                <td>
                                                                    <input type="checkbox" name="chk[]" id="chk" class="form-check-input" value="10" >
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('people.user', ['id' => 10]) }}" class="person-name">
                                                                        Amimar Smith
                                                                    </a>
                                                                </td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>
                                                                    <a href="{{ route('country', ['id' => 'Algeria']) }}" class="country-name">
                                                                        Algeria
                                                                    </a>
                                                                </td>
                                                                <td class="position-relative">
                                                                    <button
                                                                            type="button"
                                                                            class="btn btn-access btn-access--phone"
                                                                            id="10"
                                                                            onclick="accessPhoneNumber(10)"
                                                                    >
                                                                        Access Phone Number
                                                                    </button>
                                                                    <div class="message-box hide-text">
                                                                        Verified number costs one credit.
                                                                    </div>
                
                                                                    <div class="button-group hide" id="buttonGroup10">
                                                                        <a
                                                                                class="btn btn-access btn-access--phone"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-phone"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                                                                        <div
                                                                                class="message-box message-box--phone hide-text"
                                                                                id="messagePhone10"
                                                                        >
                                                                        </div>
                
                                                                        <a
                                                                                class="btn btn-access btn-access--email"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-envelope"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                
                                                                        <div
                                                                                class="message-box message-box--email hide-text"
                                                                                id="messageEmail10"
                                                                        >
                                                                            <!-- Email not available -->
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>Male</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>b'Akbou'</td>
                                                                <td></td>
                                                            </tr>
                                                            <tr class="table-row">
                                                                <td>
                                                                    <input type="checkbox" name="chk[]" id="chk" class="form-check-input" value="11" >
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('people.user', ['id' => 11]) }}" class="person-name">
                                                                        NėsSrïn MøUssådăk
                                                                    </a>
                                                                </td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>
                                                                    <a href="{{ route('country', ['id' => 'Algeria']) }}" class="country-name">
                                                                        Algeria
                                                                    </a>
                                                                </td>
                                                                <td class="position-relative">
                                                                    <button
                                                                            type="button"
                                                                            class="btn btn-access btn-access--phone"
                                                                            id="11"
                                                                            onclick="accessPhoneNumber(11)"
                                                                    >
                                                                        Access Phone Number
                                                                    </button>
                                                                    <div class="message-box hide-text">
                                                                        Verified number costs one credit.
                                                                    </div>
                
                                                                    <div class="button-group hide" id="buttonGroup11">
                                                                        <a
                                                                                class="btn btn-access btn-access--phone"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-phone"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                                                                        <div
                                                                                class="message-box message-box--phone hide-text"
                                                                                id="messagePhone11"
                                                                        >
                                                                        </div>
                
                                                                        <a
                                                                                class="btn btn-access btn-access--email"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-envelope"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                
                                                                        <div
                                                                                class="message-box message-box--email hide-text"
                                                                                id="messageEmail11"
                                                                        >
                                                                            <!-- Email not available -->
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>Female</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr class="table-row">
                                                                <td>
                                                                    <input type="checkbox" name="chk[]" id="chk" class="form-check-input" value="12" >
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('people.user', ['id' => 12]) }}" class="person-name">
                                                                        Maria Vetements
                                                                    </a>
                                                                </td>
                                                                <td></td>
                                                                <td>Facebook</td>
                                                                <td>
                                                                    <a href="{{ route('country', ['id' => 'Algeria']) }}" class="country-name">
                                                                        Algeria
                                                                    </a>
                                                                </td>
                                                                <td class="position-relative">
                                                                    <button
                                                                            type="button"
                                                                            class="btn btn-access btn-access--phone"
                                                                            id="12"
                                                                            onclick="accessPhoneNumber(12)"
                                                                    >
                                                                        Access Phone Number
                                                                    </button>
                                                                    <div class="message-box hide-text">
                                                                        Verified number costs one credit.
                                                                    </div>
                
                                                                    <div class="button-group hide" id="buttonGroup12">
                                                                        <a
                                                                                class="btn btn-access btn-access--phone"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-phone"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                                                                        <div
                                                                                class="message-box message-box--phone hide-text"
                                                                                id="messagePhone12"
                                                                        >
                                                                        </div>
                
                                                                        <a
                                                                                class="btn btn-access btn-access--email"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-envelope"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                
                                                                        <div
                                                                                class="message-box message-box--email hide-text"
                                                                                id="messageEmail12"
                                                                        >
                                                                            <!-- Email not available -->
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>Female</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>b'Algiers, Algeria'</td>
                                                                <td>b'Algiers, Algeria'</td>
                                                            </tr>
                                                            <tr class="table-row">
                                                                <td>
                                                                    <input type="checkbox" name="chk[]" id="chk" class="form-check-input" value="13" >
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('people.user', ['id' => 13]) }}" class="person-name">
                                                                        Li Za Li Za
                                                                    </a>
                                                                </td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>
                                                                    <a href="{{ route('country', ['id' => 'Algeria']) }}" class="country-name">
                                                                        Algeria
                                                                    </a>
                                                                </td>
                                                                <td class="position-relative">
                                                                    <button
                                                                            type="button"
                                                                            class="btn btn-access btn-access--phone"
                                                                            id="13"
                                                                            onclick="accessPhoneNumber(13)"
                                                                    >
                                                                        Access Phone Number
                                                                    </button>
                                                                    <div class="message-box hide-text">
                                                                        Verified number costs one credit.
                                                                    </div>
                
                                                                    <div class="button-group hide" id="buttonGroup13">
                                                                        <a
                                                                                class="btn btn-access btn-access--phone"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-phone"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                                                                        <div
                                                                                class="message-box message-box--phone hide-text"
                                                                                id="messagePhone13"
                                                                        >
                                                                        </div>
                
                                                                        <a
                                                                                class="btn btn-access btn-access--email"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-envelope"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                
                                                                        <div
                                                                                class="message-box message-box--email hide-text"
                                                                                id="messageEmail13"
                                                                        >
                                                                            <!-- Email not available -->
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>Female</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr class="table-row">
                                                                <td>
                                                                    <input type="checkbox" name="chk[]" id="chk" class="form-check-input" value="14" >
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('people.user', ['id' => 14]) }}" class="person-name">
                                                                        Nourredine Ouchabane
                                                                    </a>
                                                                </td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>
                                                                    <a href="{{ route('country', ['id' => 'Algeria']) }}" class="country-name">
                                                                        Algeria
                                                                    </a>
                                                                </td>
                                                                <td class="position-relative">
                                                                    <button
                                                                            type="button"
                                                                            class="btn btn-access btn-access--phone"
                                                                            id="14"
                                                                            onclick="accessPhoneNumber(14)"
                                                                    >
                                                                        Access Phone Number
                                                                    </button>
                                                                    <div class="message-box hide-text">
                                                                        Verified number costs one credit.
                                                                    </div>
                
                                                                    <div class="button-group hide" id="buttonGroup14">
                                                                        <a
                                                                                class="btn btn-access btn-access--phone"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-phone"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                                                                        <div
                                                                                class="message-box message-box--phone hide-text"
                                                                                id="messagePhone14"
                                                                        >
                                                                        </div>
                
                                                                        <a
                                                                                class="btn btn-access btn-access--email"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-envelope"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                
                                                                        <div
                                                                                class="message-box message-box--email hide-text"
                                                                                id="messageEmail4"
                                                                        >
                                                                            <!-- Email not available -->
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>Male</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr class="table-row">
                                                                <td>
                                                                    <input type="checkbox" name="chk[]" id="chk" class="form-check-input" value="15" >
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('people.user', ['id' => 15]) }}" class="person-name">
                                                                        لعبة القدار
                                                                    </a>
                                                                </td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>
                                                                    <a href="{{ route('country', ['id' => 'Algeria']) }}" class="country-name">
                                                                        Algeria
                                                                    </a>
                                                                </td>
                                                                <td class="position-relative">
                                                                    <button
                                                                            type="button"
                                                                            class="btn btn-access btn-access--phone"
                                                                            id="15"
                                                                            onclick="accessPhoneNumber(15)"
                                                                    >
                                                                        Access Phone Number
                                                                    </button>
                                                                    <div class="message-box hide-text">
                                                                        Verified number costs one credit.
                                                                    </div>
                
                                                                    <div class="button-group hide" id="buttonGroup15">
                                                                        <a
                                                                                class="btn btn-access btn-access--phone"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-phone"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                                                                        <div
                                                                                class="message-box message-box--phone hide-text"
                                                                                id="messagePhone15"
                                                                        >
                                                                        </div>
                
                                                                        <a
                                                                                class="btn btn-access btn-access--email"
                                                                                href=""
                                                                        >
                                                                            <i class="bi bi-envelope"></i>
                                                                            <i class="bi bi-caret-down-fill"></i>
                                                                        </a>
                
                                                                        <div
                                                                                class="message-box message-box--email hide-text"
                                                                                id="messageEmail15"
                                                                        >
                                                                            <!-- Email not available -->
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>Female</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row py-4">
                                        @if(isset($count))
                                            <div class="col-md-4 text-secondary ps-5">
                                                Filtered records: {{ $count }}
                                            </div>
                                        @else
                                            <div class="col-md-4 text-secondary ps-5">
                                            </div>
                                        @endif
                                            <div class="col-md-8 ms-auto d-flex justify-content-end">
                                                <button
                                                        type="submit"
                                                        class="btn btn-download border-3"
                                                        disabled="disabled"
                                                >
                                                    <i class="bi bi-download"></i>
                                                    &nbsp;&nbsp; Download Selected Data
                                                </button>
                                            </div>
                                    </div>
                                </div>
                                <!-- END TABLE -->

                                <!-- START PAGINATION -->
                                <div class="container paginate">
                                    <div class="row">
                                    <div class="col-md-4 pagination-warning d-none">
                                        Please add some filters to go to the second page! Pagination is
                                        disabled when there is no filter applied, for performance
                                        reasons.
                                    </div>
                                    </div>
                                    <div class="row mt-3">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-end">
                                        <li class="page-item disabled">
                                            <a
                                            class="page-link"
                                            href="#"
                                            tabindex="-1"
                                            aria-disabled="true"
                                            >Previous</a
                                            >
                                        </li>
                                        <li class="page-item warning">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                        </ul>
                                    </nav>
                                    </div>
                                </div>
                                <!-- END PAGINATION -->
                            </section>
                            <!-- END MAIN DASHBOARD -->
                    @endif
                </section>
            </main>
        </section>

        <!-- Bootstrap JS -->
        <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"
        ></script>
        <!-- jQuery -->
        <script
                src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
                integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
                crossorigin="anonymous"
                referrerpolicy="no-referrer"
        ></script>
        {{--select data from this page--}}
        <script type="text/javascript">
            $(function() {

                $(document).on('click', '#checkAll', function() {

                    if ($(this).val() == 'Select All') {
                        //$('.button input').prop('checked', true);
                        var ele=document.getElementsByName('chk[]');
                        for(var i=0; i<ele.length; i++){
                            if(ele[i].type=='checkbox')
                                ele[i].checked=true;
                        }
                        $(this).val('Deselect All');
                        $('.btn-download').prop(
                            'disabled',
                            $('input.form-check-input:checked').length == 0
                        );
                    } else {
                        //$('.button input').prop('checked', false);
                        var ele=document.getElementsByName('chk[]');
                        for(var i=0; i<ele.length; i++){
                            if(ele[i].type=='checkbox')
                                ele[i].checked=false;
                            $('.btn-download').prop(
                                'disabled',
                                $('input.form-check-input:checked').length == 0
                            );

                        }
                        $(this).val('Select All');

                    }
                });

            });
        </script>
        {{--/* Access Phone Number */--}}
        <script type="text/javascript">
            let collection,  buttonGroup, messageBox, buttonId;

            messageBox = document.getElementById('message');

            function accessPhoneNumber(id)
            {
                $.ajax({
                    url:"{{ route('peopleDataHistory') }}",
                    method:"POST",
                    data:{id:id, _token:"{{ csrf_token() }}"},
                    dataType:"json",
                    success:function(data)
                    {
                        collection = document.getElementById(id);
                        buttonGroup = document.getElementById('buttonGroup'+id);
                        buttonId = document.getElementById(id).value;
                        collection.classList.add('hide');
                        buttonGroup.classList.remove('hide');
                        for (var count = 0; count < data.length; count++) {
                            $("#messagePhone" + id).text(data[count].phone);
                            if (data[count].email != null)
                                $("#messageEmail" + id).text(data[count].email);
                            else
                                $("#messageEmail" + id).text("N/A");
                        }
                    },
                    error: function () {
                        window.location.href = "settings/upgrade";
                    }
                })

            }

        </script>
        <script type="text/javascript">
            function getCountryName(id)
            {
                let countryInput = document.getElementById('countryInput');
                countryInput.value = document.querySelector('#countryBtn'+id).value;
            }

        </script>
        <script>
            $(function () {
                $('.form-check-input').click(function () {
                    $('.btn-download').prop(
                        'disabled',
                        $('input.form-check-input:checked').length == 0
                    );
                });
            });
        </script>
        <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script defer src="{{ asset('public/js/accessPhone.js') }}" defer></script>

        <!-- Custom JS -->
        <script defer src="{{ asset('/') }}adminAsset/assets/js/navbar.min.js"></script>
        <script defer src="{{ asset('/') }}adminAsset/assets/js/people.min.js"></script>
        <script defer src="{{ asset('/') }}adminAsset/assets/js/script.min.js"></script>

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

        <script>
            window.onload = function(){
            //hide the preloader
                document.querySelector(".section-preloader").style.display = "none";
                document.querySelector(".section-content").classList.remove("d-none");
            }
        </script>
        <script>
            $(document).ready(function () {
                
                $('.submitBtn').on('click', function () {
                    document.querySelector(".section-preloader").style.display = "block";
                    document.querySelector(".section-content").classList.add("d-none");
                });
            });
        </script>
        <script type="text/javascript">
            let collection,  buttonGroup, messageBox, buttonId;

            messageBox = document.getElementById('message');

            function accessPhoneNumber(id)
            {
                $.ajax({
                    url:"{{ route('peopleDataHistory') }}",
                    method:"POST",
                    data:{id:id, _token:"{{ csrf_token() }}"},
                    dataType:"json",
                    success:function(data)
                    {
                        collection = document.getElementById(id);
                        buttonGroup = document.getElementById('buttonGroup'+id);
                        buttonId = document.getElementById(id).value;
                        collection.classList.add('hide');
                        buttonGroup.classList.remove('hide');
                        for (var count = 0; count < data.length; count++) {
                            $("#messagePhone" + id).text(data[count].phone);
                            if (data[count].email != null)
                                $("#messageEmail" + id).text(data[count].email);
                            else
                                $("#messageEmail" + id).text("N/A");
                        }
                    },
                    error: function () {
                        window.location.href = "settings/upgrade";
                    }
                })

            }

        </script>

    </body>
</html>
