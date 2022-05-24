@extends('layouts.app')
@section('content')
@include('layouts.headers.adminKendaraan')
<div class="container-fluid mt--7">
   <div class="row">
      <div class="col">
         <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Data Kendaraan PT Graha Sarana Duta</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Nopol</th>
                    <th scope="col" class="sort" data-sort="name">Area</th>
                    <th scope="col" class="sort" data-sort="name">Witel</th>
                    <th scope="col" class="sort" data-sort="name">Pool</th>
                    <th scope="col" class="sort" data-sort="budget">Merk</th>
                    <th scope="col" class="sort" data-sort="status">Users</th>
                    <th scope="col" class="sort" data-sort="status">Customers</th>
                    <th scope="col" class="sort" data-sort="status">Umur (Tahun)</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody class="list">
                @foreach($kendaraan as $k)
                 <tr>
                     <td>{{$k->nopol}}</td>
                     <td>{{$k->area}}</td>
                     <td>{{$k->witel}}</td>
                     <td>{{$k->pool}}</td>
                     <td>{{$k->merk}} {{$k->type}}</td>
                     <td>{{$k->kepemilikan}}</td>
                     <td>{{$k->customers}}</td>
                     <td>{{\Carbon\Carbon::now()->year - $k->tahun}} Tahun</td>
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
                      {{$kendaraan->links()}}
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