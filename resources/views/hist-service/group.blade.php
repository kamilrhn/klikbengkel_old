@extends('layouts.app')
@section('content')
@include('sweetalert::alert')
@include('layouts.headers.historyGroup')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="mb-0">Grouping History Service</h3>
                </div>
               <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-6 mt-3">
                        <!-- small card -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><strong>All</strong></h5>
                                <p class="card-text">All History Service</p>
                                
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('request.history') }}" class="btn btn-sm btn-danger">See All</a>
                            </div>
                        </div>
                    </div>
                    @foreach($area as $a)
                    <div class="col-lg-3 col-6 mt-3">
                        <!-- small card -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><strong>Area {{ $a->kode_area }}</strong></h5>
                                <p class="card-text">History Service Area {{ $a->kode_area }}</p>
                                
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('request.historyarea', $a->kode_area) }}" class="btn btn-sm btn-danger">See All</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
               </div>
               </div>
               <div class="card-footer py-4">
                <nav aria-label="...">
                    <div class="float-sm-right">
                        <ul class="pagination mb-0">
                            <li class="page-item">
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection
