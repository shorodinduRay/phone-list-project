@extends('userDashboard.master')

@section('body')
    <!-- START USER DASHBOARD HEADING-->
    <section
            class="section-user-dashboard-heading bg-white mt-5 pt-5 px-md-0 px-5"
    >
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12">
                    <h1 class="heading--main">Let's get started!</h1>
                    <h2 class="heading--sub pb-md-5 pb-4">
                        Hi <span>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</span>, welcome to Phone List.
                    </h2>
                </div>
                <div
                        class="col-md-6 col-10 d-flex align-items-center justify-content-md-end"
                >
                    <row>
                        <h3 class="mb-4 heading--main fs-2 fw-normal">
                            <b>Total Mobile Numbers:</b> {{ $mobile_number }}
                        </h3>
                        <div>
                            <form action="{{ route('exports')  }}" method="get" enctype="multipart/form-data">
                                @csrf
                                <button type="submit" class="btn btn-txt border-3">
                                    Visit Downloaded Data CSVs
                                    <i class="bi bi-arrow-right"></i>
                                </button>
                            </form>
                        </div>
                    </row>
                </div>
            </div>
        </div>
    </section>
    <!-- END USER DASHBOARD HEADING-->

    <!-- START USER HISTORY -->
    <section class="section-history py-5 mb-md-0 mb-5 custom-scrollbar">
        <div class="container">
            <div class="row">
                <!-- START PURCHASE HISTORY -->
                <div class="col-md-6 pe-md-5 px-5 py-md-0 py-5">
                    <h3>Purchase History</h3>
                    <canvas id="purchaseChart" width="150" height="140">
                    </canvas>
                </div>
                <!-- END PURCHASE HISTORY -->

                <!-- START BILLING HISTORY -->
                <div class="col-md-6 ps-5 pe-md-0 px-5 pt-md-0 pt-5">
                    <h3>Billing History</h3>
                    <div class="table-scrollable">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Credit Used</th>
                                <th>Data Purchased</th>
                                <th>Final Credit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($userHistory as $history)
                                <tr>
                                    <td>{{ $history->date }}</td>
                                    <td>{{ $history->usedCredit }}</td>
                                    <td>{{ $history->dataPurchase }}</td>
                                    <td>{{ $history->useAbleCredit }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END BILLING HISTORY -->
            </div>
        </div>
    </section>
    <!-- END USER HISTORY -->

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


<!-- Chart JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom JS -->
    <script defer src="{{ asset('/') }}adminAsset/assets/js/navbar.min.js"></script>
    <script defer src="{{ asset('/') }}adminAsset/assets/js/people.min.js"></script>
    <script defer src="{{ asset('/') }}adminAsset/assets/js/script.min.js"></script>

    <script>
    //Chart JS PurchaseChart Setup

    var data = <?php echo $data; ?>;
    var credit = <?php echo $credit; ?>;
    const purchaseLabels = <?php echo $day; ?>;

    const purchaseData = {
    labels: purchaseLabels,
    datasets: [
        {
            label: 'Data Purchased',
            backgroundColor: 'rgba(137, 121, 232, 1)',
            borderColor: 'rgba(137, 121, 232, 1)',
            data: data
        },
        {
            label: 'Credit Purchased',
            backgroundColor: 'rgba(75, 192, 192, 1)',
            borderColor: 'rgba(75, 192, 192, 1)',
            data: credit,
        },
    ],
    };

    const purchaseConfig = {
    type: 'line',
    data: purchaseData,
    options: {},
    };

    //Chart JS purchaseChart Configuration
    const purchaseChart = new Chart(
    document.getElementById('purchaseChart'),
    purchaseConfig
    );
    </script>
</section>
@endsection


