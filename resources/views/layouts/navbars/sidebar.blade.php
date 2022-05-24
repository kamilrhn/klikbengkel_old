<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="#">
            <img src="{{ asset('argon') }}/img/brand/klikbengkel.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="#">
                            <img src="{{ asset('argon') }}/img/brand/klikbengkel.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
           
            <ul class="navbar-nav">
                <li class="nav-item">
                    @if(Auth::user()->isAdmin() || Auth::user()->isPusat())
                    <a class="nav-link" href="{{ route('home') }}">
                    @elseif(Auth::user()->isAsman())
                    <a class="nav-link" href="{{ route('home.area', Auth::user()->resp) }}">
                    @elseif(Auth::user()->isDispatcher())
                    <a class="nav-link" href="{{ route('home.pool', Auth::user()->resp) }}">
                    @endif
                        <i class="ni ni-tv-2 text-red"></i> <span class="nav-link-text" style="color: #f4645f;">Dashboard</span>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                        <i class="fab fa-laravel" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">{{ __('Laravel Examples') }}</span>
                    </a>

                    <div class="collapse show" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile.edit') }}">
                                    {{ __('User profile') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.index') }}">
                                    {{ __('User Management') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> -->

                <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('icons') }}">
                        <i class="ni ni-planet text-blue"></i> {{ __('Request Service') }}
                    </a>
                </li> -->
                
                <li class="nav-item">
                    <a class="nav-link " href="#navbar-components" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-components">
                        <i class="ni ni-settings text-red" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">Service</span>
                    </a>
                    <div class="collapse" id="navbar-components">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->isAdmin() || Auth::user()->isDispatcher())
                            <li class="nav-item">
                                @if(Auth::user()->isAdmin())
                                <a class="nav-link"  href="{{route('404')}}">
                                @else
                                <a class="nav-link"  href="{{route('request.cek', Auth::user()->resp)}}">
                                @endif
                                    Request Service
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->isAdmin() || Auth::user()->isDispatcher())
                            <li class="nav-item">
                                @if(Auth::user()->isAdmin())
                                <a class="nav-link"  href="{{route('404')}}">
                                @else
                                <a class="nav-link"  href="{{route('request.cekurg', Auth::user()->resp)}}">
                                @endif
                                    Request Urgent Service
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->isAdmin() || Auth::user()->isDispatcher())
                            <li class="nav-item">
                                @if(Auth::user()->isAdmin())
                                <a class="nav-link" href="{{route('404')}}">
                                @else
                                <a class="nav-link"  href="{{route('request.cekpart', Auth::user()->resp)}}">
                                @endif
                                    Ganti Part
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->isAdmin() || Auth::user()->isAsman())
                            <li class="nav-item">
                                @if(Auth::user()->isAdmin())
                                <a class="nav-link"  href="{{route('404')}}">
                                @else
                                <a class="nav-link"  href="{{route('request.approval', Auth::user()->resp)}}">
                                @endif
                                    Approval Service
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->isAdmin() || Auth::user()->isAsman())
                            <li class="nav-item">
                                @if(Auth::user()->isAdmin())
                                <a class="nav-link"  href="{{route('404')}}">
                                @else
                                <a class="nav-link"  href="{{route('acc.cancel', Auth::user()->resp)}}">
                                @endif
                                    Approval Cancel Service
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->isAdmin() || Auth::user()->isDispatcher())
                            <li class="nav-item">
                                @if(Auth::user()->isAdmin())
                                <a class="nav-link"  href="{{route('404')}}">
                                @else
                                <a class="nav-link"  href="{{route('complete.pool', Auth::user()->resp)}}">
                                @endif
                                    Completion Service
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                @if(Auth::user()->isPusat())
                                <a class="nav-link" href="{{ route('request.historygsd') }}">
                                @elseif(Auth::user()->isAdmin())
                                <a class="nav-link" href="{{ route('request.historygroup') }}">
                                @elseif(Auth::user()->isAsman())
                                <a class="nav-link" href="{{ route('request.historyarea', Auth::user()->resp) }}">
                                @elseif(Auth::user()->isDispatcher())
                                <a class="nav-link" href="{{route('request.historypool', Auth::user()->resp)}}">
                                @endif
                                    History Service
                                </a>
                            </li>
                            @if(Auth::user()->isAdmin() || Auth::user()->isDispatcher())
                            <li class="nav-item">
                                @if(Auth::user()->isAdmin())
                                <a class="nav-link"  href="{{route('404')}}">
                                @else
                                <a class="nav-link"  href="{{route('cancel.list', Auth::user()->resp)}}">
                                @endif
                                    Cancel Service
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @if(Auth::user()->isDispatcher())
                <li class="nav-item ">
                    <a class="nav-link" href="{{route('reminder.index', Auth::user()->resp)}}">
                    <i class="fas fa-bell-slash text-red" aria-hidden="true"></i> <span class="nav-link-text" style="color: #f4645f;">Reminder Service <span class="badge badge-info right">1</span></span>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link " href="#navbar-invoice" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-invoice">
                        @if (Auth::user()->isDispatcher())
                        <i class="far fa-credit-card text-red" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">Payment</span> 
                        @else
                        <i class="fa fa-file-invoice-dollar text-red" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">Invoice</span> 
                        @endif
                    </a>
                    <div class="collapse" id="navbar-invoice">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->isAdmin() || Auth::user()->isAsman() || Auth::user()->isPusat())
                            <li class="nav-item">
                                @if(Auth::user()->isAdmin() || Auth::user()->isPusat())
                                <a class="nav-link" href="{{ route('invoice.index') }}">
                                @elseif(Auth::user()->isAsman())
                                <a class="nav-link" href="{{ route('invoice.indexarea', Auth::user()->resp) }}">
                                @endif
                                    List Invoice
                                </a>
                            </li>
                            @endif
                            @if (Auth::user()->isDispatcher())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('payment.list', Auth::user()->resp) }}">
                                    Submission Payment
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('payment.paid', Auth::user()->resp) }}">
                                    Confirmation Payment
                                </a>
                            </li>
                            @endif
                            @if (Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('payment.approval') }}">
                                    Approval Payment
                                </a>
                            </li>
                            @endif
                            @if (Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('payment.accept') }}">
                                    Confirm Payment
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @if(Auth::user()->isAdmin() || Auth::user()->isAsman())
                <li class="nav-item ">
                    @if(Auth::user()->isAdmin())
                    <a class="nav-link" href="#">
                    @elseif(Auth::user()->isAsman())
                    <a class="nav-link" href="#">
                    @endif
                    <i class="fa fa-info-circle text-red" aria-hidden="true"></i> <span class="nav-link-text" style="color: #f4645f;">Report</span>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link " href="#navbar-pages" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-pages">
                        <i class="fas fa-wallet text-red" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">Budget</span>
                    </a>
                    <div class="collapse" id="navbar-pages">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->isPusat())
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('release.budget')}}">
                                    Release Budget
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->isAsman())
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('distribusi.budget', Auth::user()->resp)}}">
                                    Distribusi Budget
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->isAsman() || Auth::user()->isDispatcher())
                            <li class="nav-item">
                                @if(Auth::user()->isAsman())
                                <a class="nav-link" href="{{route('topup.budget', Auth::user()->resp)}}">
                                @else
                                <a class="nav-link" href="{{route('history.budget', Auth::user()->resp)}}">
                                @endif
                                    @if(Auth::user()->isAsman())
                                    Top-Up Budget
                                    @else
                                    History Budget
                                    @endif
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->isPusat() || Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('detailpusat.budget')}}">
                                    Detail Budget
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                        <i class="fa fa-database text-red" aria-hidden="true"></i>
                        <span class="nav-link-text" style="color: #f4645f;">Manage</span>
                    </a>
                    <div class="collapse" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('manage.area') }}">
                                    Area
                                </a>
                            </li> -->
                            <li class="nav-item">
                                @if(Auth::user()->isAdmin() || Auth::user()->isPusat())
                                <a class="nav-link" href="{{ route('manage.kendaraan') }}">
                                @elseif(Auth::user()->isAsman())
                                <a class="nav-link" href="{{ route('manage.kendaraanarea', Auth::user()->resp) }}">
                                @elseif(Auth::user()->isDispatcher())
                                <a class="nav-link" href="{{ route('manage.kendaraanpool', Auth::user()->resp) }}">
                                @endif
                                    Kendaraan
                                </a>
                            </li>
                            @if(Auth::user()->isAsman())
                            <li class="nav-item">
                                <a class="nav-link" target="_blank" href="http://mymonalisa.id/">
                                    Monalisa
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->isAsman() || Auth::user()->isAdmin() || Auth::user()->isDispatcher())
                            <li class="nav-item">
                                @if(Auth::user()->isAdmin() || Auth::user()->isPusat())
                                <a class="nav-link" href="{{ route('manage.bengkel') }}">
                                @elseif(Auth::user()->isAsman())
                                <a class="nav-link" href="{{ route('manage.bengkelarea', Auth::user()->resp) }}">
                                @elseif(Auth::user()->isDispatcher())
                                <a class="nav-link" href="{{ route('manage.bengkelpool', Auth::user()->resp) }}">
                                @endif
                                    Bengkel
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Stok
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->isAsman())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('manage.service', Auth::user()->resp) }}">
                                    Service by Nopol
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->isAsman() || Auth::user()->isAdmin())
                            <li class="nav-item">
                                @if(Auth::user()->isAsman())
                                <a class="nav-link" href="{{route('manage.nonkhs', Auth::user()->resp)}}">
                                @else
                                <a class="nav-link" href="{{route('nonkhs.admin')}}">
                                @endif
                                    Data Non KHS
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->isAsman())
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('setting.index', Auth::user()->resp)}}">
                                    Pengaturan Validasi
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
				@if(Auth::user()->isDispatcher()|| Auth::user()->isAsman())
                <li class="nav-item ">
                    <a class="nav-link" href="https://gsd.mymonalisa.id/public/" target="_blank">
                    <i class="fas fa-bell-slash text-red" aria-hidden="true"></i> <span class="nav-link-text" style="color: #f4645f;">My Monalisa </span>
                    </a>
                </li>
                @endif
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-circle-08 text-pink"></i> {{ __('Register') }}
                    </a>
                </li> -->
               
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <!-- <h6 class="navbar-heading text-muted">Documentation</h6> -->
            <!-- Navigation -->
            <!-- <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link" href="https://argon-dashboard-laravel.creative-tim.com/docs/getting-started/overview.html">
                        <i class="ni ni-spaceship"></i> Getting started
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://argon-dashboard-laravel.creative-tim.com/docs/foundation/colors.html">
                        <i class="ni ni-palette"></i> Foundation
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://argon-dashboard-laravel.creative-tim.com/docs/components/alerts.html">
                        <i class="ni ni-ui-04"></i> Components
                    </a>
                </li>
            </ul> -->
        </div>
    </div>
</nav>
