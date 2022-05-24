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
                    <h3 class="mb-0">Payment to GSD</h3>
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
                                @else
                                <td><span class="badge badge-danger" style="color:#white">Declined</span></td>
                                @endif
                                <td>
                                    <a href="{{ route('payment.detail', $s->payment->kode_bayar) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Detail</a>
                                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#pay-{{ $s->no_service }}"><i class="fas fa-receipt"></i> Pay</a>
                                </td>
                            </tr>
                            <div class="modal fade" id="pay-{{ $s->no_service }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Form Pembayaran Service {{ $s->no_service }}</h5>
                                      <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('store.paid') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-address">No. Service</label>
                                                <input id="nominal" type="text" name="no_service" class="form-control"
                                                    placeholder="Masukkan Nominal Sesuai Nota" value="{{ $s->no_service }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-address">Kode Bayar</label>
                                                <input id="nominal" type="text" name="kode_bayar" class="form-control"
                                                    placeholder="Masukkan Nominal Sesuai Nota" value="{{ $s->payment->kode_bayar }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-address">File Bukti Pembayaran</label>
                                                <input id="nominal" type="file" name="proof" class="form-control"
                                                    placeholder="Masukkan Nama Bank">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-address">Notes</label>
                                                <textarea name="notes" id="" class="form-control" cols="30" rows="10"></textarea>
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