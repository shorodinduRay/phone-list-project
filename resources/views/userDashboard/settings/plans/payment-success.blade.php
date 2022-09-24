@extends('front.master')

@section('metaDescription')
@endsection


@section('title')
    Payment | Phone List
@endsection

@section('main')

<!-- START BREADCRUMB -->
<hr class="mt-lg-0 mt-5 text-secondary" />
<div class="container">
    <div class="row">
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Payment
                </li>
            </ol>
        </nav>
    </div>
</div>
<!-- END BREADCRUMB -->

<!-- START SECTION HEADER -->
<section class="section-header u-padding-lg pb-3 text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="heading">Waiting For Payment</h1><small class="text-warning">Please make sure that your browser accepts third-party cookie.</small>
                <h2 class="heading--sub">
                    <iframe src="{{$response->ipn_callback_url}}" height="600" width="400" title="Iframe Example"></iframe>
                </h2>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION HEADER -->

@endsection