@extends('layouts.app')
@section('content')
@include('sweetalert::alert')
@include('layouts.headers.complete')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('assets') }}/vendor/dropzone/dist/min/dropzone.min.js"></script>
<div class="container-fluid mt--7">
   <div class="row">
      <div class="col">
         <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
               <h3 class="mb-0">Completion Service</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
               <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                     <tr>
                        <th scope="col" class="sort" data-sort="name">No. Service</th>
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
                        <td><span class="badge badge-primary" style="color:#white">Done</span></td>
                        @else
                        <td></td>
                        @endif
                        <td>
                           <a href="" data-toggle="modal" data-target="#exampleModal-{{$s->no_service}}"
                              class="btn btn-sm btn-info"><i class="fa fa-check" aria-hidden="true"></i></a>
                        </td>
                     </tr>
                     <div class="modal fade" id="exampleModal-{{$s->no_service}}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog " role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Completion Service</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <form action="{{route('finish.service', $s->no_service)}}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                       <label class="form-control-label" for="input-address">No. Service</label>
                                       <input id="vehicle" type="text" class="form-control"
                                          placeholder="Type to Search Nopol (ex: B1234ABC)" value="{{$s->no_service}}"
                                          readonly>
                                    </div>
                                    <div class="form-group">
                                       <label class="form-control-label" for="input-address">Nopol</label>
                                       <input id="vehicle" type="text" class="form-control"
                                          placeholder="Type to Search Nopol (ex: B1234ABC)" value="{{$s->nopol}}"
                                          readonly>
                                    </div>
                                    <div class="dropzone dropzone-single">
                                       <div class="fallback">
                                          <div class="form-group">
                                             <label class="form-control-label" for="input-address">Upload Bukti Setelah
                                                Service</label>
                                             <input type="file" name="foto" class="form-control" id="uploadImg">
                                          </div>
                                       </div>
                                       <div class="dz-preview dz-preview-single mt-2">
                                          <div class="dz-preview-cover">
                                             <img class="dz-preview-img" id="previewImg"
                                                style="height:250px; width:450px;" data-dz-thumbnail>
                                          </div>
                                       </div>
                                    </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Submit</button>
                                 </form>
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

<script type="text/javascript">
   function readURL(input) {
      if (input.files && input.files[0]) {
         var reader = new FileReader();

         reader.onload = function (e) {
            $('#previewImg').attr('src', e.target.result);
         }
         reader.readAsDataURL(input.files[0]);
      }
   }
   $("#uploadImg").change(function () {
      readURL(this);
   });
</script>
@endsection