@extends('layouts.app')
@section('content')
@include('sweetalert::alert')
@include('layouts.headers.approval')
<div class="container-fluid mt--7">
   <div class="row">
      <div class="col">
         <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
               <h3 class="mb-0">Approval Service</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
               <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                     <tr>
                        <th scope="col" class="sort" data-sort="name">No. Service</th>
                        <th scope="col" class="sort" data-sort="name">Nopol</th>
                        <th scope="col" class="sort" data-sort="budget">Nama Bengkel</th>
                        <th scope="col" class="sort" data-sort="status">Tanggal Pengajuan</th>
                        <th scope="col" class="sort" data-sort="status">Status</th>
                        <th scope="col">Action</th>
                     </tr>
                  </thead>
                  <tbody class="list">
                     @foreach($service as $s)
                     <tr>
                        <td>{{$s->no_service}}</td>
                        <td>{{$s->nopol}}</td>
                        <td>{{$s->bengkel}}</td>
                        <td>{{$s->tanggal}}</td>
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
                        @elseif($s->status == 'Waiting Payment Approval')
                        <td><span class="badge badge-success" style="color:#white">Waiting Payment Approval</span></td>
                        @elseif($s->status == 'Payment Accept')
                        <td><span class="badge badge-success" style="color:#white">Payment Accept</span></td>
                        @else
                        <td><span class="badge badge-danger" style="color:#white">Declined</span></td>
                        @endif
                        <td>
                           <a href="{{route('request.detailapp', $s->no_service)}}" class="btn btn-sm btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                           <!-- <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#approve-{{$s->no_service}}"><i class="ni ni-ruler-pencil"></i></a> -->
                        </td>
                     </tr>
                     <div class="modal fade" id="approve-{{$s->no_service}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                           <div class="modal-content">
                              <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Approval</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              </div>
                              <div class="modal-body">
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <label class="form-control-label" for="input-address">Nopol</label>
                                       <input type="text" id="input-city" class="form-control" placeholder="Nama Bengkel" value="{{$s->nopol}}" readonly>
                                       <label class="form-control-label" for="input-address">Waktu Pengajuan</label>
                                       <input type="text" id="input-city" class="form-control" placeholder="Nama Bengkel" value="{{$s->tanggal}}" readonly>
                                    </div>
                                    <div class="col-lg-6">
                                       <label class="form-control-label" for="input-address">Nama Bengkel</label>
                                       <input type="text" id="input-city" class="form-control" placeholder="Nama Bengkel" value="{{$s->bengkel}}" readonly>
                                       <label class="form-control-label" for="input-address">Pool</label>
                                       <input type="text" id="input-city" class="form-control" placeholder="Nama Bengkel" value="{{$s->pool}}" readonly>
                                    </div>
                                 </div>
                                 <div class="row mt-4">
                                    <div class="col-lg-3">
                                       <h4><strong>Nama Pekerjaan</strong></h4>
                                    </div>
                                    <div class="col-lg-3">
                                       <h4><strong>Harga</strong></h4>
                                    </div>
                                    <div class="col-lg-3">
                                       <h4><strong>Qty</strong></h4>
                                    </div>
                                    <div class="col-lg-3">
                                       <h4><strong>Subtotal</strong></h4>
                                    </div>
                                 </div>
                                 
                                 <div class="row mt-2">
                                 @foreach($s->rincian as $sr)
                                    <div class="col-lg-3">
                                       <h5>{{$sr->keterangan}}</h5>
                                    </div>
                                    <div class="col-lg-3">
                                       <h5>{{$sr->harga}}</h5>
                                    </div>
                                    <div class="col-lg-3">
                                       <h5>{{$sr->qty}}</h5>
                                    </div>
                                    <div class="col-lg-3">
                                       <h5>{{$sr->subtotal}}</h5>
                                    </div>
                                 @endforeach
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-9">
                                       <div class="float-right">
                                          <h5><strong>Subtotal</strong></h5>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <h5><strong>{{$s->subtotal}}</strong></h5>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-9">
                                       <div class="float-right">
                                          <h5><strong>PPn</strong></h5>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <h5><strong>{{$s->ppn}}</strong></h5>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-9">
                                       <div class="float-right">
                                          <h5><strong>Grand Total</strong></h5>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <h5><strong>{{$s->total}}</strong></h5>
                                    </div>
                                 </div>
                              </div>
                              <div class="modal-footer mt--3">
                                 <a href="{{ route('decline.service', $s->no_service) }}" style="color:white;" class="btn btn-danger">Decline</a>
                                 <a href="{{ route('approve.service', $s->no_service) }}"  style="color:white;" class="btn btn-success">Approve</a>
                              </div>
                           </div>
                        </div>
                     </div>
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