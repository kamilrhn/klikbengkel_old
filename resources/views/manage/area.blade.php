@extends('layouts.app')
@section('content')
@include('layouts.headers.adminArea')
<div class="container-fluid mt--7">
   <div class="row">
      <div class="col">
         <div class="accordion" id="accordionExample">
            @foreach($area as $a)
            <div class="card">
               <div class="card-header"  data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <h5 class="mb-0"><strong>Area : </strong>{{$a->nama_area}}</h5>
               </div>
               <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card-body">
                     @foreach($a->witel as $w)
                     <div class="card">
                        <div class="card-header"  data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <h5 class="mb-0"><strong>Witel : </strong>{{$w->witel}}</h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                           <div class="card-body">
                              @foreach($w->pool as $p)
                              <div class="card">
                                 <div class="card-header"  data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <h5 class="mb-0"><strong>Pool : </strong>{{$p->pool}}</h5>
                                 </div>
                           </div>
                              @endforeach
                           </div>
                        </div>
                    </div>
                     @endforeach
                  </div>
               </div>
            </div>
            @endforeach
         </div>
      </div>
   </div>
   @include('layouts.footers.auth')
</div>
@endsection