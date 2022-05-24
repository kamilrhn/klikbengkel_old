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
                    <h3 class="mb-0">Submission Payment</h3>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Tanggal Selesai</th>
                                <th scope="col" class="sort" data-sort="name">No. Service</th>
                                <th scope="col" class="sort" data-sort="name">Jenis Service</th>
                                <th scope="col" class="sort" data-sort="name">Nopol</th>
                                <th scope="col" class="sort" data-sort="budget">Subtotal</th>
                                <th scope="col" class="sort" data-sort="budget">PPn</th>
                                <th scope="col" class="sort" data-sort="budget">Grand Total</th>
                                <th scope="col" class="sort" data-sort="budget">Status</th>
                                <th scope="col" class="sort" data-sort="budget">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($service as $s)
                            <tr>
                                <td>{{ $s->invoice->tanggal }}</td>
                                <td>{{ $s->no_service }}</td>
                                @if ($s->reg_urg != NULL)
                                <td>{{ $s->reg_urg }}</td>
                                @else
                                <td>-</td>
                                @endif
                                <td>{{ $s->nopol }}</td>  
                                <td>{{ number_format($s->subtotal) }}</td>
                                <td>{{ number_format($s->ppn) }}</td>
                                <td>{{ number_format($s->total) }}</td>
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
                                <td>
                                    <a href="" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#ajukan-{{ $s->no_service }}"><i class="far fa-credit-card"></i> Ajukan</a>
                                    {{-- <a href="#" class="btn btn-sm btn-info"><i class="fas fa-tasks"></i> Proses</a> --}}
                                </td>
                            </tr>
                            <div class="modal fade" id="ajukan-{{ $s->no_service }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Form Pengajuan Pembayaran Service {{ $s->no_service }}</h5>
                                      <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('store.payment') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-address">No. Service</label>
                                                <input id="nominal" type="text" name="no_service" class="form-control"
                                                    placeholder="Masukkan Nominal Sesuai Nota" value="{{ $s->no_service }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-address">Total</label>
                                                <input id="nominal" type="number" name="nominal_nota" class="form-control"
                                                    placeholder="Masukkan Nominal Sesuai Nota">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-address">Nama Rekening</label>
                                                <input id="nominal" type="text" name="nama_rekening" class="form-control"
                                                    placeholder="Masukkan Nama Rekening">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-address">No. Rekening</label>
                                                <input id="nominal" type="number" name="no_rekening" class="form-control"
                                                    placeholder="Masukkan Nomor Rekening">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-address">Nama Bank</label>
                                                <input id="nominal" type="text" name="nama_bank" class="form-control"
                                                    placeholder="Masukkan Nama Bank">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-address">File Nota</label>
                                                <input id="nominal" type="file" name="file" class="form-control"
                                                    placeholder="Masukkan Nama Bank">
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