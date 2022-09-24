@extends('admin.master')


@section('title')
    Dashboard
@endsection

@section('body')
    <!-- START MAIN BODY -->
    <section class="section-dashboard--main section-dashboard--orderHistory">
        <div class="container">
          <div class="row">
            <div class="offset-md-4 col-md-5">
              <div id="reportrange"
                style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                <i class="bi bi-calendar-week-fill"></i>&nbsp;&nbsp;&nbsp;
                <span></span>
              </div>
            </div>
            <!-- START PEOPLE SEARCHBAR -->
            <div class="col-md-3 d-flex justify-content-end">
              {{-- <input type="text" name="search" class="searchBar w-100"
                placeholder="Search Invoice ID..." /> --}}
                <form id="search" action="{{ route('invoice.search.by.credit') }}" enctype="multipart/form-data" method="get">              
                  @if(isset($res))
                      <input type="text"
                          name="search"
                          id="searchInvoiceByAdmin"
                          class="searchBar w-100"
                          onkeyup="searchInvoice()"
                          autocomplete="off"
                          placeholder="Search Invoice ID..."
                          value="{{ $res }}"/>
                  @else
                      <input type="text"
                          name="search"
                          id="searchInvoiceByAdmin"
                          class="searchBar w-100"
                          onkeyup="searchInvoice()"
                          autocomplete="off"
                          placeholder="Search Invoice ID..."/>
                  @endif
                </form>
            </div>
            <!-- END PEOPLE SEARCHBAR -->
          </div>
          <div class="row mt-4">
            <div class="col-md-5 m-auto">
              <div class="row">
                <div class="col-md-9 mx-auto">
                  <div class="card d-flex flex-row align-items-center justify-content-center p-3">
                    <i class="bi bi-file-earmark-bar-graph"></i>
                    <div class="card-body">
                      <h4 class="card-title">Total Credits Earned</h4>
                      <p class="card-text">{{ $credit_earned }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
  
            <div class="col-md-7 card rounded-3">
              <h4 class="heading--main pt-4 pb-0 px-3 mt-2 fs-2">
                Recent Credit History
              </h4>
              <canvas id="creditChart" height="200rem"></canvas>
            </div>
          </div>
  
          
          <!-- START TABLE -->
          <div class="row mt-5 pb-4 custom-scrollbar">
            <div class="col-md-12 table-scrollable ps-0" style="max-height: 54vh;">
              <table class="table table-hover table-bordered table-responsive" id="table">
                <thead>
                  <tr>
                    <th>Invoice ID</th>
                    <th>Name</th>
                    <th>Purchased Plan</th>
                    <th>Credits Used</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $orders as $order )
                  <tr class="table-row">
                    <td scope="row">
                      <div>
                        {{  $order->invoiceId }}
                      </div>
                      <div class="fs-5">
                        Paid on
                        <span>{{  $order->updated_at }}</span>
                      </div>
                    </td>
                    <td  class="name">
                      {{  $order->userName }}
                    </td>
                    <td>
                      {{  $order->purchasePlan }}
                    </td>
                    <td>
                      {{  $order->credit }}
                    </td>
                    <td>
                      <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-delete bg-success px-4" onclick="window.location='{{ route('re.download.invoice',$order->invoiceId) }}'">
                          <i class="bi bi-download"></i>
                        </button>
                      </div>
                    </td>
                  </tr>  
                  @endforeach
                  @if (@isset($notFound))
                    {{ $notFound }}
                  @endif
                </tbody>
              </table>
            </div>
          </div>
          <!-- END TABLE -->
          
          <!-- START PAGINATION -->
          <div class="row pb-2">
            <nav aria-label="Page navigation example" >
                <ul class="pagination justify-content-end">
                    <li class="page-item">
                        <div  class="d-sm-inline-flex justify-content-center">
                            {!! $orders->links() !!}
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- END PAGINATION -->
        </div>
      </section>
      <!-- END MAIN BODY -->
@endsection

@push('custom_js')
<script>
const creditLabels = new Array();
  <?php foreach($dates as $key => $date){ ?>
    creditLabels.push('<?php echo $date; ?>');
  <?php } ?>

const customerData = new Array();
  <?php foreach($customers as $key => $customer){ ?>
    customerData.push('<?php echo $customer; ?>');
  <?php } ?>

  
const creditData = {
  labels: creditLabels,
  datasets: [
    {
      label: 'New Customers',
      backgroundColor: 'rgba(54, 162, 235, 1)',
      borderColor: 'rgba(54, 162, 235, 1)',
      data: customerData,
    },
    {
      label: 'Credit Earned',
      backgroundColor: 'rgba(75, 192, 192, 1)',
      borderColor: 'rgba(75, 192, 192, 1)',
      data: [12, 20, 15, 21, 2, 10, 35],
    },
  ],
};

const creditConfig = {
  type: 'bar',
  data: creditData,
  options: {},
};

// Chart JS CreditChart Configuration
const creditChart = new Chart(
  document.getElementById('creditChart'),
  creditConfig
);
</script>
@endpush





