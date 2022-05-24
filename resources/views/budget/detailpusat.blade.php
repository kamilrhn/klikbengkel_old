@extends('layouts.app')
@section('content')
@include('sweetalert::alert')
@include('layouts.headers.budgetPusat')
<div class="container-fluid mt--7">
   <div class="row">
      <div class="col">
         <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Data Release Budget</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Area</th>
                    <th scope="col" class="sort" data-sort="name">Periode</th>
                    <th scope="col" class="sort" data-sort="name">Budget Awal</th>
                    <th scope="col" class="sort" data-sort="name">Budget Terpakai</th>
                    <th scope="col" class="sort" data-sort="name">Budget Sisa</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody class="list">
                @foreach($budget as $b)
                 <tr>
                    <td>Area {{$b->kode_area}}</td>
                    <td>{{date('F Y', strtotime($b->bulan))}}</td>   
                    <td>Rp.{{number_format($b->budget_awal)}}</td>  
                    <td>Rp.{{number_format($b->budget_awal - $b->sisa_budget)}}</td>  
                    <td>Rp.{{number_format($b->sisa_budget)}}</td> 
                    <td>
                        <a href="{{route('rincianpusat.budget', $b->kode)}}" class="btn btn-sm btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    </td> 
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