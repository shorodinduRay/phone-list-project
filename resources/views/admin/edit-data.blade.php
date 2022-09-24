<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
          rel="stylesheet">

    <!-- BOOTSTRAP ICONS     -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />

    <!-- DATATABLE CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" />

    <!-- BOOTSTRAP TABLE CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}adminAsset/assets/css/style.css" />
    <title>Dashboard</title>
    <link rel="shortcut icon" href="{{ asset('/') }}adminAsset/assets/images/icons/favicon.ico" />
</head>

<body>

<section class="section-dashboard">
    <!-- START SIDEBAR -->
    <section class="section-dashboard--sidebar">
        <!-- START MENU -->
        <nav class="menubar">
            <ul class="menu d-flex flex-column">
                <li class="">
                    <a href="admin.html" class="navbar-brand">
                        <img src="{{ asset('/') }}adminAsset/assets/images/logo--company-name.png" alt="logo" />
                    </a>
                </li>
                <li class="menu-item ">
                    <a href="admin.html">
                        <i class="bi bi-collection menu-item--icon "></i>
                        <span class="menu-item--text ">
                Dashboard
              </span>
                    </a>
                </li>
                <li class="menu-item active">
                    <a href="viewData.html">
                        <i class="bi bi-clipboard-data menu-item--icon "></i>
                        <span class="menu-item--text ">
                View All Data
              </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="">
                        <i class="bi bi-person-badge menu-item--icon "></i>
                        <span class="menu-item--text ">
                User Details
              </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="">
                        <i class="bi bi-box-arrow-in-down menu-item--icon "></i>
                        <span class="menu-item--text ">
                User Data Import
              </span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="">
                        <i class="bi bi-bar-chart menu-item--icon"></i>
                        <span class="menu-item--text">
                Order History
              </span>
                    </a>
                </li>
                </a>
                <li class="menu-item">
                    <a href="">
                        <i class="bi bi-currency-bitcoin menu-item--icon"></i>
                        <span class="menu-item--text">
                Credit History
              </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="">
                        <i class="bi bi-arrow-left-right menu-item--icon"></i>
                        <span class="menu-item--text">
                Credit Transfer
              </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="">
                        <i class="bi bi-wallet2 menu-item--icon"></i>
                        <span class="menu-item--text">
                Payment Settings
              </span>
                    </a>
                </li>
                <li class="menu-item menu-item-footer">
                    <a href="home.html">
                        <i class="bi bi-power menu-item--icon"></i>
                        <span class="menu-item--text">
                Logout
              </span>
                    </a>
                </li>
                </a>
            </ul>
        </nav>
        <!-- END MENU -->
    </section>
    <!-- END SIDEBAR -->

    <!-- START MAIN BODY -->
    <section class="section-dashboard--main section-viewalldata">
        <div class="container">

            <div class="row mb-4">
                <div class="col-md-2 m-auto">
                    <h3 class="fw-light">Total Entries: <span>101</span> </h3>
                </div>

                <!-- START PEOPLE SEARCHBAR -->
                <div class="offset-md-7 col-md-3 d-flex justify-content-end">
                    <input type="text" name="search" id="searchPeople" class="searchBar w-100" onkeyup="searchPeople()"
                           placeholder="Search People..." />
                </div>
                <!-- END PEOPLE SEARCHBAR -->
            </div>

            <!-- START TABLE -->
            <div class="row pt-2 pb-4">

                <!-- TODO Add table-scrollable to col-md-12 -->
                <div class="col-md-12 table-scrollable">
                    <table class="table table-hover table-bordered table-responsive" id="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Facebook URL</th>

                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Maliha Mustafa </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td scope="row" class="name">
                                <a href="user01.html"> Shamonti Haque </a>
                            </td>
                            <td>+880 111111111</td>
                            <td>
                                shamontihaque@seoexpartebd.com
                            </td>
                            <td>www.facebook.com/1234</td>

                            <td>
                                <button type="button" class="btn btn-edit bg-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-delete bg-danger">Delete</button>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>


                <!-- START MODAL FOR EDIT  -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <form>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name">
                                    </div>

                                    <div class="mb-3">
                                        <label for="number" class="form-label">Phone number</label>
                                        <input type="tel" class="form-control" id="number">
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email">
                                    </div>

                                    <div class="mb-3">
                                        <label for="facebook" class="form-label">Facebook URL</label>
                                        <input type="url" class="form-control" id="facebook">
                                    </div>

                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <input type="text" class="form-control" id="gender">
                                    </div>

                                    <div class="mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control" id="city">
                                    </div>

                                    <div class="mb-3">
                                        <label for="state" class="form-label">State</label>
                                        <input type="text" class="form-control" id="state">
                                    </div>

                                    <div class="mb-3">
                                        <label for="country" class="form-label">Country</label>
                                        <input type="text" class="form-control" id="country">
                                    </div>

                                    <div class="mb-3">
                                        <label for="hometown_city" class="form-label">Hometown City</label>
                                        <input type="text" class="form-control" id="hometown_city">
                                    </div>

                                    <div class="mb-3">
                                        <label for="hometown_state" class="form-label">Hometown State</label>
                                        <input type="text" class="form-control" id="hometown_state">
                                    </div>

                                    <div class="mb-3">
                                        <label for="hometown_country" class="form-label">Hometown Country</label>
                                        <input type="text" class="form-control" id="hometown_country">
                                    </div>

                                    <div class="mb-3">
                                        <label for="relation" class="form-label">Relationship Status</label>
                                        <input type="text" class="form-control" id="relation">
                                    </div>

                                    <div class="mb-3">
                                        <label for="education" class="form-label">Education Last Year</label>
                                        <input type="number" class="form-control" id="education">
                                    </div>

                                    <div class="mb-3">
                                        <label for="work" class="form-label">Workplace</label>
                                        <input type="text" class="form-control" id="work">
                                    </div>


                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MODAL FOR EDIT  -->

            </div>

            <!-- END TABLE -->
        </div>
    </section>
    <!-- END MAIN BODY -->
</section>


<!-- BOOTSTRAP JS -->
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<!-- Chart JS -->
<script defer src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Custom JS -->
<script defer src="{{ asset('/') }}adminAsset/assets/js/script.min.js"></script>
<script defer src="{ asset('/') }}adminAsset/assets/js/dashboard.min.js"></script>

<!-- jQuery -->
<script defer src="https://code.jquery.com/jquery-3.5.1.js"></script>

<!-- DataTable JS -->
<script defer src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<!-- Bootstrap Table JS -->
<script defer src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#table').DataTable();
    });
</script>

</body>

</html>
