@extends('layouts.app')
@section('content')
@include('layouts.headers.cari')
<div class="container-fluid mt--7">
   <div class="row">
      <div class="col">
         <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
               <h3 class="mb-0">Data Service {{$search}}</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
               <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                     <tr>
                        <th scope="col" class="sort" data-sort="name">No Service</th>
                        <th scope="col" class="sort" data-sort="name">Nopol</th>
                        <th scope="col" class="sort" data-sort="name">Tanggal Service</th>
                        <th scope="col" class="sort" data-sort="name">Status</th>
                        <th scope="col" class="sort" data-sort="name">Odoometer Service</th>
                        <th scope="col">Action</th>
                     </tr>
                  </thead>
                  <tbody class="list">
                     @foreach($service as $s)
                     <tr>
                        <td>{{$s->no_service}}</td>
                        <td>{{$s->nopol}}</td>
                        <td>{{date('d F Y', strtotime($s->tanggal))}}</td>
                        @if($s->status == 'Waiting')
                        <td><span class="badge badge-danger" style="color:#white">Waiting</span></td>
                        @elseif($s->status == 'On Service')
                        <td><span class="badge badge-info" style="color:#white">On Service</span></td>
                        @elseif($s->status == 'On Warranty')
                        <td><span class="badge badge-warning" style="color:#white">On Warranty</span></td>
                        @elseif($s->status == 'Done')
                        <td><span class="badge badge-success" style="color:#white">Done</span></td>
                        @elseif($s->status == 'Request Cancel')
                        <td><span class="badge badge-success" style="color:#white">Request Cancel</span></td>
                        @else
                        <td><span class="badge badge-danger" style="color:#white">Declined</span></td>
                        @endif
                        <td>{{number_format($s->km)}}</td>
                        <td>
                           <a href="{{route('part.detail', $s->no_service)}}" class="btn btn-sm btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
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