@extends('layouts.app')
@section('content')
@include('layouts.headers.reminder')
<div class="container-fluid mt--7">
   <div class="row">
      <div class="col">
         <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Reminder Service {{Auth::user()->resp}}</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Nopol</th>
                    <th scope="col" class="sort" data-sort="name">Tanggal Service Terakhir</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody class="list">
                  <td>B1234ABC</td>
                  <td>26/05/2021</td>
                  <td></td>
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