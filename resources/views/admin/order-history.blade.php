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
            <!-- START INVOICE SEARCHBAR -->
            
            <div class="col-md-3 d-flex justify-content-end">
              {{-- <input type="text" name="search" class="searchBar w-100"
                placeholder="Search Invoice ID..." /> --}}
                <form id="search" action="{{ route('invoice.search.by.admin') }}" enctype="multipart/form-data" method="get">              
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
            <!-- END INVOICE SEARCHBAR -->
          </div>
          <div class="row mt-4">
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-6 p-0">
                  <div class="card d-flex flex-row align-items-center justify-content-center p-3">
                    <i class="bi bi-file-earmark-bar-graph"></i>
                    <div class="card-body">
                      <h4 class="card-title">Total Sales</h4>
                      <p class="card-text">${{ $total_sales }}</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 p-0 px-4">
                  <div class="card d-flex flex-row align-items-center justify-content-center p-3">
                    <i class="bi bi-credit-card-2-back-fill"></i>
                    <div class="card-body">
                      <h4 class="card-title">Card Total</h4>
                      <p class="card-text">${{ $card_total }}</p>
                    </div>
                  </div>
                </div>
              </div>
  
              <div class="row mt-4">
                <div class="col-md-6 p-0 ">
                  <div class="card d-flex flex-row align-items-center justify-content-center p-3">
                    <i class="bi bi-paypal"></i>
                    <div class="card-body">
                      <h4 class="card-title">Crypto Total</h4>
                      <p class="card-text">${{ $now_pay_total }}</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 p-0 px-4">
                  <div class="card d-flex flex-row align-items-center justify-content-center p-3">
                    <i class="bi bi-cart-fill"></i>
                    <div class="card-body">
                      <h4 class="card-title">Total Orders</h4>
                      <p class="card-text">{{ $count }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
  
            <div class="col-md-6 card rounded-3">
              <h4 class="heading--main pt-4 pb-0 px-3 mt-2 fs-2">
                Sales Report
              </h4>
              <canvas id="salesChart" height="183rem"></canvas>
            </div>
          </div>
  
          
          <!-- START TABLE -->
          <div class="row mt-5 pb-4 custom-scrollbar">
            <div class="col-md-12 table-scrollable px-0" style="max-height: 54vh;">
              <table class="table table-hover table-bordered table-responsive" id="table">
                <thead>
                  <tr>
                    <th>Invoice ID</th>
                    <th>Name</th>
                    <th>Purchased Plan</th>
                    <th>Paid By</th>
                    <th>Amount</th>
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
                      <div>
                        {{  $order->paidBy }}
                      </div>
                    </td>
                    <td>{{  $order->amount }}</td>
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





