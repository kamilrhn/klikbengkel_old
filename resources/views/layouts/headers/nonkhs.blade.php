<div class="header pb-8 pt-5 pt-md-8" style="background-color:#ed1c24;">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Data Part atau Service Non-KHS</h6>
                </div>
                <div class="col-lg-6 col-7">
                    <div class="float-sm-right">
                        @if(Auth::user()->isAsman())
                        <a href="{{route('excel.nonkhs', Auth::user()->resp)}}" class="btn btn-sm btn-neutral">Export Excel</a>
                        @else
                        <a href="#" class="btn btn-sm btn-neutral">Export Excel</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>