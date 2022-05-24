@extends('layouts.app')
@section('content')
@include('sweetalert::alert')
@include('layouts.headers.topupBudget')
<div class="container-fluid mt--7">
   <div class="row">
      <div class="col">
         <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Topup Budget Area {{Auth::user()->resp}}</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Periode</th>
                    <th scope="col" class="sort" data-sort="name">Area</th>
                    <th scope="col" class="sort" data-sort="name">Witel</th>
                    <th scope="col" class="sort" data-sort="name">Pool</th>
                    <th scope="col" class="sort" data-sort="name">Nominal</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody class="list">
                @foreach($budget as $b)
                 <tr>
                    <td>{{date('F Y', strtotime($b->created_at))}}</td> 
                    <td>Area {{$b->kode_area}}</td>  
                    <td>{{$b->witel}}</td>
                    <td>{{$b->pool}}</td>   
                    <td>Rp.{{number_format($b->budget)}}</td>    
                    <td>{{$b->keterangan}}</td>  
                 </tr>
                 @endforeach
                </tbody>
              </table>
            </div>
            
            <!-- Card footer -->
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