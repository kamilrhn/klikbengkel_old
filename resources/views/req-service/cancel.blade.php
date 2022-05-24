@extends('layouts.app')
@section('content')
@include('sweetalert::alert')
@include('layouts.headers.cancel')
<div class="container-fluid mt--7">
   <div class="row">
      <div class="col">
         <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Request Cancel Service</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">No. Service</th>
                    <th scope="col" class="sort" data-sort="name">Jenis Service</th>
                    <th scope="col" class="sort" data-sort="name">Nopol</th>
                    <th scope="col" class="sort" data-sort="name">Area</th>
                    <th scope="col" class="sort" data-sort="name">Pool</th>
                    <th scope="col" class="sort" data-sort="budget">Nama Bengkel</th>
                    <th scope="col" class="sort" data-sort="status">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody class="list">
                  @foreach($service as $s)
                  <tr>
                     <td>{{$s->no_service}}</td>
                     @if($s->reg_urg != NULL)
                     <td>{{$s->reg_urg}}</td>
                     @else
                     <td>-</td>
                     @endif
                     <td>{{$s->nopol}}</td>
                     <td>{{$s->area}}</td>
                     <td>{{$s->pool}}</td>
                     <td>{{$s->bengkel}}</td>
                     @if($s->status == 'Waiting')
                     <td><span class="badge badge-danger" style="color:#white">Waiting</span></td>
                     @elseif($s->status == 'On Service')
                     <td><span class="badge badge-info" style="color:#white">On Service</span></td>
                     @elseif($s->status == 'On Warranty')
                     <td><span class="badge badge-warning" style="color:#white">On Warranty</span></td>
                     @elseif($s->status == 'Done')
                     <td><span class="badge badge-success" style="color:#white">Done</span></td>
                     @elseif($s->status == 'Request Cancel')
                     <td><span class="badge badge-danger" style="color:#white">Request to Cancel</span></td>
                     @elseif($s->status == 'Cancel')
                     <td><span class="badge badge-danger" style="color:#white">Canceled</span></td>
                     @else
                     <td><span class="badge badge-danger" style="color:#white">Declined</span></td>
                     @endif
                     <td>
                        <a href="{{route('cancel.detail', $s->no_service)}}" class="btn btn-sm btn-info"><i class="fa fa-times" aria-hidden="true"></i></a>
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
                      {{$service->links()}}
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