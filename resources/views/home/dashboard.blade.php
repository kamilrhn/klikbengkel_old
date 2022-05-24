@extends('layouts.app')
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
@section('content')
@if(Auth::user()->isPusat())
    @include('layouts.headers.cardscompany')
@else
    @include('layouts.headers.cards')
@endif
    <div class="container-fluid mt--7">
       
        <div class="row mt--6">
	        @if(Auth::user()->isAsman() || Auth::user()->isPusat() || Auth::user()->isAdmin())
            <div class="col-xl-6">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">History Budget {{\Carbon\Carbon::now()->format('M Y')}}</h3>
                            </div>
                            <div class="col float-right">
                               <span class="text-black mb--3">
                                   <strong>Total Budget</strong>    : Rp. {{ number_format($budget_awal) }} <br>
                                   <strong>Sisa Budget</strong>     : Rp. {{ number_format($sisa_budget) }}
                               </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="card">
                            @foreach ($budget as $b)
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="float-sm-left" style="margin-left:-45px;">
                                            <h4><strong>Area {{$b->kode_area}} <br> {{ date('F Y', strtotime($b->bulan)) }}</strong></h4>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="col text-right">
                                            <span>
                                                Budget Awal : Rp.{{number_format($b->budget_awal)}} <br>
                                                Sisa Budget : Rp.{{number_format($b->sisa_budget)}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            @if( request()->route()->uri == 'home/ALL' )
                            <h3><a href="{{ route('detailpusat.budget') }}">Lihat Lebih Banyak</a></h3>
                            @else
                            <h3><a href="{{ route('distribusi.budget', request()->segment(count(request()->segments()))) }}">Lihat Lebih Banyak</a></h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-xl-6">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">History SPS</h3>
                            </div>
                            <div class="col text-right">
                                @if(Auth::user()->isAdmin())
                                <a class="btn btn-sm btn-primary" style="background-color:#808080;" href="{{ route('request.history') }}">See all</a>
                                @elseif(Auth::user()->isAsman())
                                <a class="btn btn-sm btn-primary" style="background-color:#808080;" href="{{ route('request.historyarea', Auth::user()->resp) }}">See all</a>
                                @elseif(Auth::user()->isDispatcher())
                                <a class="btn btn-sm btn-primary" style="background-color:#808080;" href="{{ route('request.historypool', Auth::user()->resp) }}">See all</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card">
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
                                
                                @if(Auth::user()->isDispatcher() || Auth::user()->isAsman()|| Auth::user()->isAdmin())
                                <th scope="col" class="sort" data-sort="budget">Subtotal</th>
                                <th scope="col" class="sort" data-sort="budget">PPn</th>
                                <th scope="col" class="sort" data-sort="budget">Grand Total</th>
                                @endif
                                @if(Auth::user()->isAdmin())
                                <th scope="col" class="sort" data-sort="budget">Profit</th>
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
                                @if(Auth::user()->isDispatcher() || Auth::user()->isAsman()|| Auth::user()->isAdmin())
                                <td>{{number_format($s->subtotal)}}</td>
                                <td>{{number_format($s->ppn)}}</td>
                                <td>{{number_format($s->total)}}</td>
                                @endif
                                @if(Auth::user()->isAdmin())
                                @if($s->payment != NULL)
                                <td>{{ number_format($s->payment->profit) }}</td>
                                @else
                                <td>Not Defined Yet</td>
                                @endif
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
                                @elseif($s->status == 'Paid')
                                <td><span class="badge badge-success" style="color:#white">Done</span></td>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-6">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Diagram Kendaraan</h3>
                            </div>
                            <div class="col text-right">
                                @if(Auth::user()->isAdmin())
                                <a class="btn btn-sm btn-primary" style="background-color:#808080;" href="{{ route('request.history') }}">See all</a>
                                @elseif(Auth::user()->isAsman())
                                <a class="btn btn-sm btn-primary" style="background-color:#808080;" href="{{ route('request.historyarea', Auth::user()->resp) }}">See all</a>
                                @elseif(Auth::user()->isDispatcher())
                                <a class="btn btn-sm btn-primary" style="background-color:#808080;" href="{{ route('request.historypool', Auth::user()->resp) }}">See all</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="card">
                            <div id="kendaraan"></div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Plat B / Plat Lokal</h3>
                            </div>
                            <div class="col text-right">
                                @if(Auth::user()->isAdmin())
                                <a class="btn btn-sm btn-primary" style="background-color:#808080;" href="{{ route('manage.kendaraan') }}">See all</a>
                                @elseif(Auth::user()->isAsman())
                                <a class="btn btn-sm btn-primary" style="background-color:#808080;" href="{{ route('manage.kendaraanarea', Auth::user()->resp) }}">See all</a>
                                @elseif(Auth::user()->isDispatcher())
                                <a class="btn btn-sm btn-primary" style="background-color:#808080;" href="{{ route('manage.kendaraanpool', Auth::user()->resp) }}">See all</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="plat"></div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
<script type="text/javascript">
Highcharts.chart('plat', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Plat B/Plat Lokal'
    },
    credits: {
        enabled : false
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f} % of Total </b>',

    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '{point.y1:.1f} % = {point.y:.f} Kendaraan'
            },
            showInLegend: true
        },
        point: {
        events: {
            click: function(){
                window.location.href = this.link;
            }
        }
    }
    },
    series: [{
        name: 'Plat B',
        colorByPoint: true,
        data: [{
            name: 'Plat B',
            y: {!!json_encode($platb)!!},
            y1: {!!json_encode($pplatb)!!},
            sliced: true,
            selected: true
        }, {
            name: 'Plat Lokal',
            y: {!!json_encode($lokal)!!},
            y1: {!!json_encode($plokal)!!},
            sliced: true,
            selected: true
        }]
    }]
});
Highcharts.chart('kendaraan', {
    chart: {
        type: 'column'
    },
    credits: {
        enabled : false
    },
    title: {
        text: 'Diagram Kendaraan'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total'
        }

    },
   
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f} Kendaraan'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.f}<br/>'
    },

    series: [
        {
            name: "Diagram Kendaraan",
            colorByPoint: true,
            data: [
                {
                    name: "Jumlah Kendaraan",
                    y: {!!json_encode($kendaraan)!!},
                    y1: {!!json_encode($kendaraan)!!}
                },
                {
                    name: "On Service",
                    y: {!!json_encode($serviceOngoing)!!},
                    y1: {!!json_encode($serviceOngoing)!!}
                },
                {
                    name: "On Warranty",
                    y: {!!json_encode($serviceOnwarran)!!},
                    y1: {!!json_encode($serviceOnwarran)!!}
                },
                {
                    name: "Done",
                    y: {!!json_encode($serviceDone)!!},
                    y1: {!!json_encode($serviceDone)!!}
                },
            ]
        }
    ],
   
});
</script>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush