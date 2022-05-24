@extends('layouts.app')
@section('content')
@include('layouts.headers.invoice')
<div class="container-fluid mt--7">
   <div class="row">
      <div class="col">
         <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="mb-0">Daftar Invoice</h3>
                    </div>
                </div>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Invoice No</th>
                    <th scope="col" class="sort" data-sort="budget">Service No</th>
                    <th scope="col" class="sort" data-sort="budget">Nama Bengkel</th>
                    <th scope="col" class="sort" data-sort="budget">Jenis Bengkel</th>
                    <th scope="col" class="sort" data-sort="budget">Nopol</th>
                    <th scope="col" class="sort" data-sort="status">Tanggal Invoice</th>
                    <th scope="col" class="sort" data-sort="status">Total</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody class="list">
                @foreach($invoice as $i)
                  <tr>
                     <td>{{$i->no_invoice}}</td>
                     <td>{{$i->no_service}}</td>
                     <td>{{$i->service->bengkel}}</td>
                     <td>{{$i->service->jenis_bengkel}}</td>
                     <td>{{$i->service->nopol}}</td>
                     <td>{{$i->tanggal}}</td>
                     <td>{{number_format($i->total)}}</td>
                     <td>
                        <a href="#" class="btn btn-sm btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        <a href="{{route('invoice.pdf', $i->no_invoice)}}" target="_blank" class="btn btn-sm btn-info"><i class="fas fa-print" aria-hidden="true"></i></a>
                     </td>
                 </tr>
                 @endforeach
                </tbody>
              </table>
            </div>
            <!-- Card footer -->
            <div class="card-footer py-4">
              <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  <li class="page-item">
                    {{$invoice->links()}}
                  </li>
                </ul>
              </nav>
            </div>
          </div>
      </div>
   </div>
   @include('layouts.footers.auth')
</div>
@endsection