@extends('layouts.app')
@section('content')
@include('sweetalert::alert')
@include('layouts.headers.historyService')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">History Service</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Tanggal</th>
                                <th scope="col" class="sort" data-sort="name">No. Service</th>
                                <th scope="col" class="sort" data-sort="name">Jenis Service</th>
                                <th scope="col" class="sort" data-sort="name">Nopol</th>
                                <th scope="col" class="sort" data-sort="name">Area</th>
                                <th scope="col" class="sort" data-sort="name">Pool</th>
                                @if(Auth::user()->isDispatcher() || Auth::user()->isAsman() || Auth::user()->isAdmin())
                                <th scope="col" class="sort" data-sort="budget">Jenis Bengkel</th>
                                <th scope="col" class="sort" data-sort="budget">Nama Bengkel</th>
                                @endif
                                @if(Auth::user()->isDispatcher() || Auth::user()->isAsman())
                                <th scope="col" class="sort" data-sort="budget">Subtotal</th>
                                <th scope="col" class="sort" data-sort="budget">PPn</th>
                                <th scope="col" class="sort" data-sort="budget">Grand Total</th>
                                @endif
                                <th scope="col" class="sort" data-sort="status">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($service as $s)
                            <tr>
                                <td>{{$s->tanggal}}</td>
                                <td>{{$s->no_service}}</td>
                                @if($s->reg_urg != NULL)
                                <td>{{$s->reg_urg}}</td>
                                @else
                                <td>-</td>
                                @endif
                                <td>{{$s->nopol}}</td>
                                <td>{{$s->area}}</td>
                                <td>{{$s->pool}}</td>
                                @if(Auth::user()->isDispatcher() || Auth::user()->isAsman() || Auth::user()->isAdmin())
                                <td>{{$s->jenis_bengkel}}</td>
                                <td>{{$s->bengkel}}</td>
                                @endif
                                @if(Auth::user()->isDispatcher() || Auth::user()->isAsman())
                                <td>{{number_format($s->subtotal)}}</td>
                                <td>{{number_format($s->ppn)}}</td>
                                <td>{{number_format($s->total)}}</td>
                                @endif
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
                                    <a href="{{route('request.detail', $s->no_service)}}" class="btn btn-sm btn-info"><i
                                            class="fa fa-eye" aria-hidden="true"></i></a>
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
