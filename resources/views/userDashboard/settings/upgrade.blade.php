<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta name="description" content="" />
    <meta name="keywords" content="phone list, " />

    <title>Pricing | Phone List</title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous"
    />

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"
    />

    <!-- Font awesome Icons -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&display=swap"
        rel="stylesheet"
    />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}adminAsset/assets/css/style.css" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/') }}adminAsset/assets/images/icons/favicon.ico" />
</head>

<body>
<header>
    <!-- START NAVBAR -->
    <nav class="navbar navbar--user navbar-expand-md navbar-light">
        <div class="nav-left__box d-flex container-fluid">
            <a class="navbar-brand" href="{{ route('/') }}">
                <img
                    class="img-fluid"
                    src="{{ asset('/') }}adminAsset/assets/images/logo.svg"
                    alt="phone list"
                />
            </a>

            <ul class="me-auto mb-md-2 mb-lg-0 d-flex flex-row">
                <li class="nav-item pl-4">
                    <a class="nav-link" aria-current="page" href="{{ route('account') }}">
                        Settings
                    </a>
                </li>

                <i class="bi bi-chevron-right d-flex align-items-center"></i>

                <li class="nav-item">
                    <a class="nav-link text-secondary"> Upgrade Plan </a>
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

    <!-- FIXME hide when clicked somewhere else -->
    <!-- START SHOW WHEN CLICKED ON PHONE -->
    <div class="u-box-shadow-1 phone-call__div hide">
        <div class="phone-call--icon">
            <i class="bi bi-telephone-outbound text-primary"></i>
        </div>
        <div class="phone-call--text">
            Instantly click-to-call prospects from anywhere.
        </div>
        <div class="phone-call--button btn-purple">Upgrade to Professional</div>
        <a class="phone-call--link"> Learn more </a>
    </div>
    <!-- END SHOW WHEN CLICKED ON PHONE -->

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
    <!-- START SECTION HEADER -->
    <section class="section-header u-padding-lg pb-3 text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="heading">Upgrade Your Plan</h1>
                    <h2 class="heading--sub">
                        Pricing for small and large companies
                    </h2>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION HEADER -->
    <!-- START PACKAGES -->
    <section
        class="section-packages u-padding-lg pt-5 px-sm-0 d-flex justify-content-center"
    >
        @if(isset($paypal))
            <div class="container mx-md-5 px-md-5">
                <div class="row mx-lg-5 mb-md-5 justify-content-center">
                    <div class="col-md-4 col-sm-6 col-9">
                        <div class="pricingTable">
                            <div class="pricingTable-header">
                                <i class="bi bi-send-fill"></i>
                                <div class="price-value">
                                    $0 <span class="month">per month</span>
                                </div>
                            </div>
                            <h3 class="heading">Free</h3>
                            <div class="pricing-content">
                                <ul>
                                    <li><i class="bi bi-check2"></i>20 Credits</li>
                                    <li><i class="bi bi-check2"></i>20 Phone Numbers</li>
                                    <li><i class="bi bi-check2"></i>Basic Filters</li>
                                    <li><i class="bi bi-check2"></i>CSV Export</li>
                                </ul>
                            </div>
                            <div class="pricingTable-signup">
                                <form action="" method="" enctype="">
                                    <input hidden  type="number" name="credit" value="20"/>
                                    <input hidden  type="number" name="phoneNumber" value="20"/>
                                    <input hidden  type="text" name="dataFilter" value="Basic Filters"/>
                                    <input hidden  type="text" name="csvExport" value="CSV Export"/>
                                    <input hidden  type="number" name="price" value="0"/>
                                    <input hidden  type="text" name="userId" value="{{ Auth::user()->id }}"/>
                                    <div class="pricingTable-signup">
                                        <button type="submit" class="btn btn-default">sign up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-9">
                        <div class="pricingTable green">
                            <div class="pricingTable-header">
                                <i class="bi bi-file-earmark-fill"></i>

                                <div class="price-value">
                                    $100 <span class="month">per month</span>
                                </div>
                            </div>
                            <h3 class="heading">Basic</h3>
                            <div class="pricing-content">
                                <ul>
                                    <li><i class="bi bi-check2"></i>5K Credits</li>
                                    <li><i class="bi bi-check2"></i>5K Phone Numbers</li>
                                    <li><i class="bi bi-check2"></i>Data Filters</li>
                                    <li><i class="bi bi-check2"></i>CSV Export</li>
                                </ul>
                            </div>
                            <div class="pricingTable-signup">
                                <form action="{{ route('paypal') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input hidden  type="number" name="credit" value="5000"/>
                                    <input hidden  type="number" name="phoneNumber" value="5000"/>
                                    <input hidden  type="text" name="dataFilter" value="Data Filters"/>
                                    <input hidden  type="text" name="csvExport" value="CSV Export"/>
                                    <input hidden  type="number" name="price" value="100"/>
                                    <input hidden  type="number" name="userId" value="{{ Auth::user()->id }}"/>
                                    <input hidden  type="text" name="plan" value="Basic"/>
                                    <div class="pricingTable-signup">
                                        <button type="submit" class="btn btn-default">sign up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-9">
                        <div class="pricingTable blue">
                            <div class="pricingTable-header">
                                <i class="bi bi-award-fill"></i>
                                <div class="price-value">
                                    $190 <span class="month">per month</span>
                                </div>
                            </div>
                            <h3 class="heading">Professional</h3>
                            <div class="pricing-content">
                                <ul>
                                    <li><i class="bi bi-check2"></i>10K Credits</li>
                                    <li><i class="bi bi-check2"></i>10K Phone Numbers</li>
                                    <li><i class="bi bi-check2"></i>Data Filters</li>
                                    <li><i class="bi bi-check2"></i>CSV Export</li>
                                </ul>
                            </div>
                            <div class="pricingTable-signup">
                                <form action="{{ route('paypal') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input hidden  type="number" name="credit" value="10000"/>
                                    <input hidden  type="number" name="phoneNumber" value="10000"/>
                                    <input hidden  type="text" name="dataFilter" value="Data Filters"/>
                                    <input hidden  type="text" name="csvExport" value="CSV Export"/>
                                    <input hidden  type="number" name="price" value="190"/>
                                    <input hidden  type="text" name="userId" value="{{ Auth::user()->id }}"/>
                                    <input hidden  type="text" name="plan" value="Professional"/>
                                    <div class="pricingTable-signup">
                                        <button type="submit" class="btn btn-default">sign up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mx-lg-5 mt-md-5 justify-content-center">
                    <div class="col-md-4 col-sm-6 col-9 mt-md-3">
                        <div class="pricingTable red">
                            <div class="pricingTable-header">
                                <i class="bi bi-briefcase-fill"></i>
                                <div class="price-value">
                                    $400 <span class="month">per month</span>
                                </div>
                            </div>
                            <h3 class="heading">Business</h3>
                            <div class="pricing-content">
                                <ul>
                                    <li><i class="bi bi-check2"></i>50K Credits</li>
                                    <li><i class="bi bi-check2"></i>50K Phone Numbers</li>
                                    <li><i class="bi bi-check2"></i>Data Filters</li>
                                    <li><i class="bi bi-check2"></i>CSV Export</li>
                                </ul>
                            </div>
                            <div class="pricingTable-signup">
                                <form action="{{ route('paypal') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input hidden  type="number" name="credit" value="50000"/>
                                    <input hidden  type="number" name="phoneNumber" value="50000"/>
                                    <input hidden  type="text" name="dataFilter" value="Data Filters"/>
                                    <input hidden  type="text" name="csvExport" value="CSV Export"/>
                                    <input hidden  type="number" name="price" value="400"/>
                                    <input hidden  type="text" name="userId" value="{{ Auth::user()->id }}"/>
                                    <input hidden  type="text" name="plan" value="Business"/>
                                    <div class="pricingTable-signup">
                                        <button type="submit" class="btn btn-default">sign up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-9 mt-md-3">
                        <div class="pricingTable red">
                            <div class="pricingTable-header">
                                <i class="bi bi-briefcase-fill"></i>
                                <div class="price-value">
                                    $1000 <span class="month">per month</span>
                                </div>
                            </div>
                            <h3 class="heading">Business Pro</h3>
                            <div class="pricing-content">
                                <ul>
                                    <li><i class="bi bi-check2"></i>300K Credits</li>
                                    <li><i class="bi bi-check2"></i>300K Phone Numbers</li>
                                    <li><i class="bi bi-check2"></i>Data Filters</li>
                                    <li><i class="bi bi-check2"></i>CSV Export</li>
                                </ul>
                            </div>
                            <div class="pricingTable-signup">
                                <form action="{{ route('paypal') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input hidden  type="number" name="credit" value="300000"/>
                                    <input hidden  type="number" name="phoneNumber" value="300000"/>
                                    <input hidden  type="text" name="dataFilter" value="Data Filters"/>
                                    <input hidden  type="text" name="csvExport" value="CSV Export"/>
                                    <input hidden  type="number" name="price" value="1000"/>
                                    <input hidden  type="text" name="userId" value="{{ Auth::user()->id }}"/>
                                    <input hidden  type="text" name="plan" value="Business Pro"/>
                                    <div class="pricingTable-signup">
                                        <button type="submit" class="btn btn-default">sign up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-9 mt-3">
                        <div class="pricingTable red">
                            <div class="pricingTable-header">
                                <i class="bi bi-handbag-fill"></i>
                                <div class="price-value">
                                    $1500<span class="month">&nbsp;</span>
                                </div>
                            </div>
                            <h3 class="heading">Enterprise</h3>
                            <div class="pricing-content">
                                <ul>
                                    <li><i class="bi bi-check2"></i>1M Credits</li>
                                    <li><i class="bi bi-check2"></i>1M Phone Numbers</li>
                                    <li><i class="bi bi-check2"></i>Data Filters</li>
                                    <li><i class="bi bi-check2"></i>CSV Export</li>
                                </ul>
                            </div>
                            <div class="pricingTable-signup">
                                <form action="{{ route('paypal') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input hidden  type="number" name="credit" value="10000000"/>
                                    <input hidden  type="number" name="phoneNumber" value="10000"/>
                                    <input hidden  type="text" name="dataFilter" value="Data Filters"/>
                                    <input hidden  type="text" name="csvExport" value="CSV Export"/>
                                    <input hidden  type="number" name="price" value="1500"/>
                                    <input hidden  type="text" name="userId" value="{{ Auth::user()->id }}"/>
                                    <input hidden  type="text" name="plan" value="Enterprise"/>
                                    <div class="pricingTable-signup">
                                        <button type="submit" class="btn btn-default">sign up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mx-lg-5 mt-md-5 justify-content-center">
                    <div class="col-md-4 col-sm-6 col-9 mt-3">
                        <div class="pricingTable red">
                            <div class="pricingTable-header">
                                <i class="bi bi-handbag-fill"></i>
                                <div class="price-value">
                                    Talk to Sales<span class="month">&nbsp;</span>
                                </div>
                            </div>
                            <h3 class="heading">Custom</h3>
                            <div class="pricing-content">
                                <ul>
                                    <li><i class="bi bi-check2"></i>Unlimited Credits</li>
                                    <li><i class="bi bi-check2"></i>Unlimited Phone Numbers</li>
                                    <li><i class="bi bi-check2"></i>Data Filters</li>
                                    <li><i class="bi bi-check2"></i>CSV Export</li>
                                </ul>
                            </div>
                            <div class="pricingTable-signup">
                                <form action="" method="" enctype="">
                                    <button type="submit" class="btn btn-default">Contact Us</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(isset($bitcoin))
            <div class="container mx-md-5 px-md-5">
                <div class="row mx-lg-5 mb-md-5 justify-content-center">
                    <div class="col-md-4 col-sm-6 col-9">
                        <div class="pricingTable">
                            <div class="pricingTable-header">
                                <i class="bi bi-send-fill"></i>
                                <div class="price-value">
                                    $0 <span class="month">per month</span>
                                </div>
                            </div>
                            <h3 class="heading">Free</h3>
                            <div class="pricing-content">
                                <ul>
                                    <li><i class="bi bi-check2"></i>20 Credits</li>
                                    <li><i class="bi bi-check2"></i>20 Phone Numbers</li>
                                    <li><i class="bi bi-check2"></i>Basic Filters</li>
                                    <li><i class="bi bi-check2"></i>CSV Export</li>
                                </ul>
                            </div>
                            <div class="pricingTable-signup">
                                <form action="" method="" enctype="">
                                    <input hidden  type="number" name="credit" value="20"/>
                                    <input hidden  type="number" name="phoneNumber" value="20"/>
                                    <input hidden  type="text" name="dataFilter" value="Basic Filters"/>
                                    <input hidden  type="text" name="csvExport" value="CSV Export"/>
                                    <input hidden  type="number" name="price" value="0"/>
                                    <input hidden  type="text" name="userId" value="{{ Auth::user()->id }}"/>
                                    <div class="pricingTable-signup">
                                        <button type="submit" class="btn btn-default">sign up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-9">
                        <div class="pricingTable green">
                            <div class="pricingTable-header">
                                <i class="bi bi-file-earmark-fill"></i>

                                <div class="price-value">
                                    $100 <span class="month">per month</span>
                                </div>
                            </div>
                            <h3 class="heading">Basic</h3>
                            <div class="pricing-content">
                                <ul>
                                    <li><i class="bi bi-check2"></i>5K Credits</li>
                                    <li><i class="bi bi-check2"></i>5K Phone Numbers</li>
                                    <li><i class="bi bi-check2"></i>Data Filters</li>
                                    <li><i class="bi bi-check2"></i>CSV Export</li>
                                </ul>
                            </div>
                            <div class="pricingTable-signup">
                                <form action="{{ route('payments.crypto.pay') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input hidden  type="number" name="credit" value="5000"/>
                                    <input hidden  type="number" name="phoneNumber" value="5000"/>
                                    <input hidden  type="text" name="dataFilter" value="Data Filters"/>
                                    <input hidden  type="text" name="csvExport" value="CSV Export"/>
                                    <input hidden  type="number" name="price" value="100"/>
                                    <input hidden  type="number" name="amountUSD" value="100"/>
                                    <input hidden  type="number" name="userId" value="{{ Auth::user()->id }}"/>
                                    <input hidden  type="number" name="userID" value="{{ Auth::user()->id }}"/>
                                    <input hidden  type="text" name="plan" value="Basic"/>
                                    <input hidden  type="text" name="paidBy" value="bitcoin"/>
                                    <input hidden type="text" name="orderID" value="1"/>
                                    <input type="hidden" name="redirect" value="{{ url()->full() }}">
                                    <div class="pricingTable-signup">
                                        <button type="submit" class="btn btn-default">sign up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-9">
                        <div class="pricingTable blue">
                            <div class="pricingTable-header">
                                <i class="bi bi-award-fill"></i>
                                <div class="price-value">
                                    $190 <span class="month">per month</span>
                                </div>
                            </div>
                            <h3 class="heading">Professional</h3>
                            <div class="pricing-content">
                                <ul>
                                    <li><i class="bi bi-check2"></i>10K Credits</li>
                                    <li><i class="bi bi-check2"></i>10K Phone Numbers</li>
                                    <li><i class="bi bi-check2"></i>Data Filters</li>
                                    <li><i class="bi bi-check2"></i>CSV Export</li>
                                </ul>
                            </div>
                            <div class="pricingTable-signup">
                                <form action="{{ route('payments.crypto.pay') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input hidden  type="number" name="credit" value="10000"/>
                                    <input hidden  type="number" name="phoneNumber" value="10000"/>
                                    <input hidden  type="text" name="dataFilter" value="Data Filters"/>
                                    <input hidden  type="text" name="csvExport" value="CSV Export"/>
                                    <input hidden  type="number" name="price" value="190"/>
                                    <input hidden  type="number" name="amountUSD" value="190"/>
                                    <input hidden  type="text" name="userId" value="{{ Auth::user()->id }}"/>
                                    <input hidden  type="number" name="userID" value="{{ Auth::user()->id }}"/>
                                    <input hidden  type="text" name="plan" value="Professional"/>
                                    <input hidden  type="text" name="paidBy" value="bitcoin"/>
                                    <input hidden type="text" name="orderID" value="1"/>
                                    <input type="hidden" name="redirect" value="{{ url()->full() }}">
                                    <div class="pricingTable-signup">
                                        <button type="submit" class="btn btn-default">sign up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mx-lg-5 mt-md-5 justify-content-center">
                    <div class="col-md-4 col-sm-6 col-9 mt-md-3">
                        <div class="pricingTable red">
                            <div class="pricingTable-header">
                                <i class="bi bi-briefcase-fill"></i>
                                <div class="price-value">
                                    $400 <span class="month">per month</span>
                                </div>
                            </div>
                            <h3 class="heading">Business</h3>
                            <div class="pricing-content">
                                <ul>
                                    <li><i class="bi bi-check2"></i>50K Credits</li>
                                    <li><i class="bi bi-check2"></i>50K Phone Numbers</li>
                                    <li><i class="bi bi-check2"></i>Data Filters</li>
                                    <li><i class="bi bi-check2"></i>CSV Export</li>
                                </ul>
                            </div>
                            <div class="pricingTable-signup">
                                <form action="{{ route('payments.crypto.pay') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input hidden  type="number" name="credit" value="50000"/>
                                    <input hidden  type="number" name="phoneNumber" value="50000"/>
                                    <input hidden  type="text" name="dataFilter" value="Data Filters"/>
                                    <input hidden  type="text" name="csvExport" value="CSV Export"/>
                                    <input hidden  type="number" name="price" value="400"/>
                                    <input hidden  type="number" name="amountUSD" value="400"/>
                                    <input hidden  type="text" name="userId" value="{{ Auth::user()->id }}"/>
                                    <input hidden  type="number" name="userID" value="{{ Auth::user()->id }}"/>
                                    <input hidden  type="text" name="plan" value="Business"/>
                                    <input hidden  type="text" name="paidBy" value="bitcoin"/>
                                    <input hidden type="text" name="orderID" value="1"/>
                                    <input type="hidden" name="redirect" value="{{ url()->full() }}">

                                    <div class="pricingTable-signup">
                                        <button type="submit" class="btn btn-default">sign up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-9 mt-md-3">
                        <div class="pricingTable red">
                            <div class="pricingTable-header">
                                <i class="bi bi-briefcase-fill"></i>
                                <div class="price-value">
                                    $1000 <span class="month">per month</span>
                                </div>
                            </div>
                            <h3 class="heading">Business Pro</h3>
                            <div class="pricing-content">
                                <ul>
                                    <li><i class="bi bi-check2"></i>300K Credits</li>
                                    <li><i class="bi bi-check2"></i>300K Phone Numbers</li>
                                    <li><i class="bi bi-check2"></i>Data Filters</li>
                                    <li><i class="bi bi-check2"></i>CSV Export</li>
                                </ul>
                            </div>
                            <div class="pricingTable-signup">
                                <form action="{{ route('payments.crypto.pay') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input hidden  type="number" name="credit" value="300000"/>
                                    <input hidden  type="number" name="phoneNumber" value="300000"/>
                                    <input hidden  type="text" name="dataFilter" value="Data Filters"/>
                                    <input hidden  type="text" name="csvExport" value="CSV Export"/>
                                    <input hidden  type="number" name="price" value="1000"/>
                                    <input hidden  type="number" name="amountUSD" value="1000"/>
                                    <input hidden  type="text" name="userId" value="{{ Auth::user()->id }}"/>
                                    <input hidden  type="number" name="userID" value="{{ Auth::user()->id }}"/>
                                    <input hidden  type="text" name="plan" value="Business Pro"/>
                                    <input hidden  type="text" name="paidBy" value="bitcoin"/>
                                    <input hidden type="text" name="orderID" value="1"/>
                                    <input type="hidden" name="redirect" value="{{ url()->full() }}">
                                    <div class="pricingTable-signup">
                                        <button type="submit" class="btn btn-default">sign up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-9 mt-3">
                        <div class="pricingTable red">
                            <div class="pricingTable-header">
                                <i class="bi bi-handbag-fill"></i>
                                <div class="price-value">
                                    $1500<span class="month">&nbsp;</span>
                                </div>
                            </div>
                            <h3 class="heading">Enterprise</h3>
                            <div class="pricing-content">
                                <ul>
                                    <li><i class="bi bi-check2"></i>1M Credits</li>
                                    <li><i class="bi bi-check2"></i>1M Phone Numbers</li>
                                    <li><i class="bi bi-check2"></i>Data Filters</li>
                                    <li><i class="bi bi-check2"></i>CSV Export</li>
                                </ul>
                            </div>
                            <div class="pricingTable-signup">
                                <form action="{{ route('payments.crypto.pay') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input hidden  type="number" name="credit" value="10000000"/>
                                    <input hidden  type="number" name="phoneNumber" value="10000"/>
                                    <input hidden  type="text" name="dataFilter" value="Data Filters"/>
                                    <input hidden  type="text" name="csvExport" value="CSV Export"/>
                                    <input hidden  type="number" name="price" value="1500"/>
                                    <input hidden  type="number" name="amountUSD" value="1500"/>
                                    <input hidden  type="text" name="userId" value="{{ Auth::user()->id }}"/>
                                    <input hidden  type="number" name="userID" value="{{ Auth::user()->id }}"/>
                                    <input hidden  type="text" name="plan" value="Enterprise"/>
                                    <input hidden  type="text" name="paidBy" value="bitcoin"/>
                                    <input hidden type="text" name="orderID" value="1"/>
                                    <input type="hidden" name="redirect" value="{{ url()->full() }}">
                                    <div class="pricingTable-signup">
                                        <button type="submit" class="btn btn-default">sign up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mx-lg-5 mt-md-5 justify-content-center">
                    <div class="col-md-4 col-sm-6 col-9 mt-3">
                        <div class="pricingTable red">
                            <div class="pricingTable-header">
                                <i class="bi bi-handbag-fill"></i>
                                <div class="price-value">
                                    Talk to Sales<span class="month">&nbsp;</span>
                                </div>
                            </div>
                            <h3 class="heading">Custom</h3>
                            <div class="pricing-content">
                                <ul>
                                    <li><i class="bi bi-check2"></i>Unlimited Credits</li>
                                    <li><i class="bi bi-check2"></i>Unlimited Phone Numbers</li>
                                    <li><i class="bi bi-check2"></i>Data Filters</li>
                                    <li><i class="bi bi-check2"></i>CSV Export</li>
                                </ul>
                            </div>
                            <div class="pricingTable-signup">
                                <form action="" method="" enctype="">
                                    <button type="submit" class="btn btn-default">Contact Us</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="container mx-md-5 px-md-5">
                <div class="row mx-lg-5 mb-md-5 justify-content-center">
                    <div class="col-md-4 col-sm-6 col-9">
                        <div class="pricingTable">
                            <div class="pricingTable-header">
                                <i class="bi bi-send-fill"></i>
                                <div class="price-value">
                                    $0 <span class="month">per month</span>
                                </div>
                            </div>
                            <h3 class="heading">Free</h3>
                            <div class="pricing-content">
                                <ul>
                                    <li><i class="bi bi-check2"></i>20 Credits</li>
                                    <li><i class="bi bi-check2"></i>20 Phone Numbers</li>
                                    <li><i class="bi bi-check2"></i>Basic Filters</li>
                                    <li><i class="bi bi-check2"></i>CSV Export</li>
                                </ul>
                            </div>
                            <div class="pricingTable-signup">
                                <form action="" method="" enctype="">
                                    <input hidden  type="number" name="credit" value="20"/>
                                    <input hidden  type="number" name="phoneNumber" value="20"/>
                                    <input hidden  type="text" name="dataFilter" value="Basic Filters"/>
                                    <input hidden  type="text" name="csvExport" value="CSV Export"/>
                                    <input hidden  type="number" name="price" value="0"/>
                                    <input hidden  type="text" name="userId" value="{{ Auth::user()->id }}"/>
                                    <div class="pricingTable-signup">
                                        <button type="submit" class="btn btn-default">sign up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-9">
                        <div class="pricingTable green">
                            <div class="pricingTable-header">
                                <i class="bi bi-file-earmark-fill"></i>

                                <div class="price-value">
                                    $100 <span class="month">per month</span>
                                </div>
                            </div>
                            <h3 class="heading">Basic</h3>
                            <div class="pricing-content">
                                <ul>
                                    <li><i class="bi bi-check2"></i>5K Credits</li>
                                    <li><i class="bi bi-check2"></i>5K Phone Numbers</li>
                                    <li><i class="bi bi-check2"></i>Data Filters</li>
                                    <li><i class="bi bi-check2"></i>CSV Export</li>
                                </ul>
                            </div>
                            <div class="pricingTable-signup">
                                <form action="{{ route('billingRequest') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input hidden  type="number" name="planId" value="2"/>
                                    <input hidden  type="number" name="credit" value="5000"/>
                                    <input hidden  type="number" name="phoneNumber" value="5000"/>
                                    <input hidden  type="text" name="dataFilter" value="Data Filters"/>
                                    <input hidden  type="text" name="csvExport" value="CSV Export"/>
                                    <input hidden  type="number" name="price" value="100"/>
                                    <input hidden  type="number" name="userId" value="{{ Auth::user()->id }}"/>
                                    <input hidden  type="text" name="plan" value="Basic"/>
                                    <div class="pricingTable-signup">
                                        <button type="submit" class="btn btn-default">sign up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-9">
                        <div class="pricingTable blue">
                            <div class="pricingTable-header">
                                <i class="bi bi-award-fill"></i>
                                <div class="price-value">
                                    $190 <span class="month">per month</span>
                                </div>
                            </div>
                            <h3 class="heading">Professional</h3>
                            <div class="pricing-content">
                                <ul>
                                    <li><i class="bi bi-check2"></i>10K Credits</li>
                                    <li><i class="bi bi-check2"></i>10K Phone Numbers</li>
                                    <li><i class="bi bi-check2"></i>Data Filters</li>
                                    <li><i class="bi bi-check2"></i>CSV Export</li>
                                </ul>
                            </div>
                            <div class="pricingTable-signup">
                                <form action="{{ route('billingRequest') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input hidden  type="number" name="planId" value="3"/>
                                    <input hidden  type="number" name="credit" value="10000"/>
                                    <input hidden  type="number" name="phoneNumber" value="10000"/>
                                    <input hidden  type="text" name="dataFilter" value="Data Filters"/>
                                    <input hidden  type="text" name="csvExport" value="CSV Export"/>
                                    <input hidden  type="number" name="price" value="190"/>
                                    <input hidden  type="text" name="userId" value="{{ Auth::user()->id }}"/>
                                    <input hidden  type="text" name="plan" value="Professional"/>
                                    <div class="pricingTable-signup">
                                        <button type="submit" class="btn btn-default">sign up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mx-lg-5 mt-md-5 justify-content-center">
                    <div class="col-md-4 col-sm-6 col-9 mt-md-3">
                        <div class="pricingTable red">
                            <div class="pricingTable-header">
                                <i class="bi bi-briefcase-fill"></i>
                                <div class="price-value">
                                    $400 <span class="month">per month</span>
                                </div>
                            </div>
                            <h3 class="heading">Business</h3>
                            <div class="pricing-content">
                                <ul>
                                    <li><i class="bi bi-check2"></i>50K Credits</li>
                                    <li><i class="bi bi-check2"></i>50K Phone Numbers</li>
                                    <li><i class="bi bi-check2"></i>Data Filters</li>
                                    <li><i class="bi bi-check2"></i>CSV Export</li>
                                </ul>
                            </div>
                            <div class="pricingTable-signup">
                                <form action="{{ route('billingRequest') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input hidden  type="number" name="planId" value="4"/>
                                    <input hidden  type="number" name="credit" value="50000"/>
                                    <input hidden  type="number" name="phoneNumber" value="50000"/>
                                    <input hidden  type="text" name="dataFilter" value="Data Filters"/>
                                    <input hidden  type="text" name="csvExport" value="CSV Export"/>
                                    <input hidden  type="number" name="price" value="400"/>
                                    <input hidden  type="text" name="userId" value="{{ Auth::user()->id }}"/>
                                    <input hidden  type="text" name="plan" value="Business"/>
                                    <div class="pricingTable-signup">
                                        <button type="submit" class="btn btn-default">sign up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-9 mt-md-3">
                        <div class="pricingTable red">
                            <div class="pricingTable-header">
                                <i class="bi bi-briefcase-fill"></i>
                                <div class="price-value">
                                    $1000 <span class="month">per month</span>
                                </div>
                            </div>
                            <h3 class="heading">Business Pro</h3>
                            <div class="pricing-content">
                                <ul>
                                    <li><i class="bi bi-check2"></i>300K Credits</li>
                                    <li><i class="bi bi-check2"></i>300K Phone Numbers</li>
                                    <li><i class="bi bi-check2"></i>Data Filters</li>
                                    <li><i class="bi bi-check2"></i>CSV Export</li>
                                </ul>
                            </div>
                            <div class="pricingTable-signup">
                                <form action="{{ route('billingRequest') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input hidden  type="number" name="planId" value="5"/>
                                    <input hidden  type="number" name="credit" value="300000"/>
                                    <input hidden  type="number" name="phoneNumber" value="300000"/>
                                    <input hidden  type="text" name="dataFilter" value="Data Filters"/>
                                    <input hidden  type="text" name="csvExport" value="CSV Export"/>
                                    <input hidden  type="number" name="price" value="1000"/>
                                    <input hidden  type="text" name="userId" value="{{ Auth::user()->id }}"/>
                                    <input hidden  type="text" name="plan" value="Business Pro"/>
                                    <div class="pricingTable-signup">
                                        <button type="submit" class="btn btn-default">sign up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-9 mt-3">
                        <div class="pricingTable red">
                            <div class="pricingTable-header">
                                <i class="bi bi-handbag-fill"></i>
                                <div class="price-value">
                                    $1500<span class="month">&nbsp;</span>
                                </div>
                            </div>
                            <h3 class="heading">Enterprise</h3>
                            <div class="pricing-content">
                                <ul>
                                    <li><i class="bi bi-check2"></i>1M Credits</li>
                                    <li><i class="bi bi-check2"></i>1M Phone Numbers</li>
                                    <li><i class="bi bi-check2"></i>Data Filters</li>
                                    <li><i class="bi bi-check2"></i>CSV Export</li>
                                </ul>
                            </div>
                            <div class="pricingTable-signup">
                                <form action="{{ route('billingRequest') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input hidden  type="number" name="planId" value="6"/>
                                    <input hidden  type="number" name="credit" value="10000000"/>
                                    <input hidden  type="number" name="phoneNumber" value="10000"/>
                                    <input hidden  type="text" name="dataFilter" value="Data Filters"/>
                                    <input hidden  type="text" name="csvExport" value="CSV Export"/>
                                    <input hidden  type="number" name="price" value="1500"/>
                                    <input hidden  type="text" name="userId" value="{{ Auth::user()->id }}"/>
                                    <input hidden  type="text" name="plan" value="Enterprise"/>
                                    <div class="pricingTable-signup">
                                        <button type="submit" class="btn btn-default">sign up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mx-lg-5 mt-md-5 justify-content-center">
                    <div class="col-md-4 col-sm-6 col-9 mt-3">
                        <div class="pricingTable red">
                            <div class="pricingTable-header">
                                <i class="bi bi-handbag-fill"></i>
                                <div class="price-value">
                                    Talk to Sales<span class="month">&nbsp;</span>
                                </div>
                            </div>
                            <h3 class="heading">Custom</h3>
                            <div class="pricing-content">
                                <ul>
                                    <li><i class="bi bi-check2"></i>Unlimited Credits</li>
                                    <li><i class="bi bi-check2"></i>Unlimited Phone Numbers</li>
                                    <li><i class="bi bi-check2"></i>Data Filters</li>
                                    <li><i class="bi bi-check2"></i>CSV Export</li>
                                </ul>
                            </div>
                            <div class="pricingTable-signup">
                                <form action="" method="" enctype="">
                                    <button type="submit" class="btn btn-default">Contact Us</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </section>
    <!-- END PACKAGES -->

    <!-- START Frequently Asked Questions -->
    <section class="section-packages-faq u-padding-lg pt-5">
        <div class="container">
            <div class="row">
                <div class="card u-box-shadow-2 rounded-3 border-0 p-5">
                    <div class="card-title text-center pt-5">
                        Frequently Asked Questions
                    </div>

                    <div class="card-body">
                        <div class="faq" id="faq">
                            <!-- FAQ 01 -->
                            <div class="faq-item my-4 bg-tranparent">
                                <h4 class="faq-header" id="headingOne">
                                    <button
                                        class="faq-button d-flex align-items-center"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne"
                                        aria-expanded="true"
                                        aria-controls="collapseOne"
                                    >
                                        <i class="bi bi-caret-down-square-fill"></i>
                                        <span>
                          How many different types of data do I receive?
                        </span>
                                    </button>
                                </h4>
                                <div
                                    id="collapseOne"
                                    class="faq-collapse collapse"
                                    aria-labelledby="headingOne"
                                    data-bs-parent="#faq"
                                >
                                    <div class="faq-body">
                                        Phone List provides you with name, title, phone number,
                                        location related to each and everyone of the contacts.
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ 02 -->
                            <div class="faq-item my-4 bg-tranparent">
                                <h4 class="faq-header" id="headingTwo">
                                    <button
                                        class="faq-button d-flex align-items-center"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo"
                                        aria-expanded="true"
                                        aria-controls="collapseTwo"
                                    >
                                        <i class="bi bi-caret-down-square-fill"></i>
                                        <span>
                          How many different types of data do I receive?
                        </span>
                                    </button>
                                </h4>
                                <div
                                    id="collapseTwo"
                                    class="faq-collapse collapse"
                                    aria-labelledby="headingTwo"
                                    data-bs-parent="#faq"
                                >
                                    <div class="faq-body">
                                        Phone List provides you with name, title, phone number,
                                        location related to each and everyone of the contacts.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END  Frequently Asked Questions -->

    <!-- Custom JS -->
    <script defer src="{{ asset('/') }}adminAsset/assets/js/navbar.min.js"></script>
    <script defer src="{{ asset('/') }}adminAsset/assets/js/script.min.js"></script>

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
</body>
</html>
