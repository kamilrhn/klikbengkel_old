@extends('layouts.app')
@section('content')
@include('layouts.headers.bengkel')
<div class="container-fluid mt--7">
   <div class="row">
      <div class="col">
         <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Data Bengkel Rekanan PT Graha Sarana Duta Pool {{Auth::user()->resp}}</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Nama Bengkel</th>
                    <th scope="col" class="sort" data-sort="name">Alamat</th>
                    <th scope="col" class="sort" data-sort="name">No. Telp</th>
                    <th scope="col" class="sort" data-sort="name">Pool Terdekat</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody class="list">
                @foreach($bengkel as $k)
                 <tr>
                     <td>{{$k->nama_bengkel}}</td>
                     <td>{{$k->alamat}}</td>
                     <td>{{$k->no_telp}} ({{$k->pic}})</td>
                     <td>{{$k->pool}}</td>
                     <td>
                        <a href="#" class="btn btn-sm btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        <a href="#" class="btn btn-sm btn-warning"><i class="ni ni-ruler-pencil"></i></a>
                        <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
                      {{$bengkel->links()}}
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