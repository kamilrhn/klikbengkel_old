@extends('layouts.app')
@section('content')
@include('sweetalert::alert')
@include('layouts.headers.payment')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('assets') }}/vendor/dropzone/dist/min/dropzone.min.js"></script>
<div class="container-fluid mt--7">
    <div class="row">
       <div class="col">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="mb-0">Approval Payment</h3>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Kode Bayar</th>
                                <th scope="col" class="sort" data-sort="name">Tanggal Pengajuan</th>
                                <th scope="col" class="sort" data-sort="name">No. Service</th>
                                <th scope="col" class="sort" data-sort="budget">Nominal Service</th>
                                <th scope="col" class="sort" data-sort="budget">Nominal Nota</th>
                                <th scope="col" class="sort" data-sort="budget">Profit</th>
                                <th scope="col" class="sort" data-sort="budget">Status</th>
                                <th scope="col" class="sort" data-sort="budget">#</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($service as $s)
                            <tr>
                                <td>{{ $s->payment->kode_bayar }}</td>
                                <td>{{ date('Y-m-d', strtotime($s->payment->created_at)) }}</td>
                                <td>{{ $s->no_service }}</td>
                                <td>{{ number_format($s->total) }}</td>
                                <td>{{ number_format($s->payment->nominal_nota) }}</td>
                                <td>{{ number_format($s->payment->profit) }}</td>
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
                                <td><span class="badge badge-success" style="color:#white">Waiting for Payment</span></td>
                                @elseif($s->status == 'Paid')
                                <td><span class="badge badge-success" style="color:#white">Paid</span></td>
                                @else
                                <td><span class="badge badge-danger" style="color:#white">Declined</span></td>
                                @endif
                                <td>
                                    <a href="{{ route('payment.detail', $s->payment->kode_bayar) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Detail</a>
                                    <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-receipt"></i> Pay</a>
                                </td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav aria-label="...">
                        <div class="float-sm-right">
                            <ul class="pagination mb-0">
                                <li class="page-item">
                                    {{ $service->links() }}
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