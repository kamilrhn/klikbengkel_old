@extends('layouts.app')
@section('content')
@include('layouts.headers.nonkhs')
<div class="container-fluid mt--7">
   <div class="row">
      <div class="col">
         <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              @if(Auth::user()->isAsman())
              <h3 class="mb-0">Data Non-KHS Area {{Auth::user()->resp}}</h3>
              @else
              <h3 class="mb-0">Data Non-KHS </h3>
              @endif
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Nama Service/Part</th>
                    <th scope="col" class="sort" data-sort="name">Harga</th>
                  </tr>
                </thead>
                <tbody class="list">
                @foreach($nonkhs as $k)
                 <tr>
                     <td>{{$k->nama}}</td>
                     <td>{{number_format($k->harga)}}</td>
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
                      {{$nonkhs->links()}}
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