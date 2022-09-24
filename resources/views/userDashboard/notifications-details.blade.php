
@extends('userDashboard.settings.master')

@section('main')
    <!-- START MAIN -->
    <section class="section-main">
        <h2 class="px-4 pt-4 fw-bold text-black">All notifications</h2>

        @foreach ($notifications as $notification)
            <div class="card u-box-shadow-2 m-4 border rounded-3">
                <div class="card-body">
                <div class="notification-box">
                    <div class="notification-text">
                    {{$notification->description}}
                    </div>
                    <div class="notification-time">
                    <span> {{ date("d F Y", strtotime($notification->date)) }} {{ $notification->time}} </span>
                    </div>
                </div>
                </div>
            </div>
        @endforeach
        <!-- START PAGINATION -->
        <div class="container">
          <div class="row">
            <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-end pe-3">
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- END PAGINATION -->
    </section>
      <!-- END MAIN -->
@endsection
