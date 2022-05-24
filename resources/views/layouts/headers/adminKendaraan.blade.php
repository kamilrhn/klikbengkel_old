<div class="header pb-8 pt-5 pt-md-8" style="background-color:#ed1c24;">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Manage Data Kendaraan</h6>
                </div>
                <div class="col-lg-6 col-7">
                    <div class="float-sm-right">
                        <form action="{{ route('kendaraan.search') }}" method="GET" class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                            <div class="form-group mb-0">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input class="form-control" name="search" placeholder="Search" type="text">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if(Auth::user()->isPusat())
            <form action="{{ route('find.kbm') }}" method="get" enctype="multipart/form-data">
                <div class="row align-items-center d-flex">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <div class="form-control-label" style="color:white;">Area</div>
                            <select class="form-control" name="area" id="areaSelect">
                                <option value="" @if($areaSelect == NULL) selected @endif>Pilih Salah Satu</option>
                                @foreach($area as $a)
                                <option value="{{$a->kode_area}}" {{ old('area') == $a->kode_area ? "selected" : "" }} @if($areaSelect == $a->kode_area) selected @endif>{{$a->nama_area}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group" id="witel">
                            <div class="form-control-label" style="color:white;">Witel</div>
                            <select class="form-control" name="witel" id="witelSelect">
                                <option value="" selected disabled>Pilih Salah Satu</option>
                                @foreach($witel as $w)
                                <option value="{{$w->witel}}" data-tag="{{ $w->kode_area }}" >{{$w->witel}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <div class="form-control-label" style="color:white;">Pool</div>
                            <select class="form-control" name="pool" id="poolSelect">
                                <option value="" selected disabled>Pilih Salah Satu</option>
                                @foreach($pool as $p)
                                <option value="{{$p->pool}}" data-tag="{{ $p->witel }}">{{$p->pool}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <br>
                            <button type="submit" class="btn btn-md btn-white btn-block">Search</button>
                        </div>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
	$('#areaSelect').on('change', function() {
		var selected = $(this).val();
		$("#witelSelect option").each(function(item){
			console.log(selected) ;  
			var element =  $(this) ; 
			console.log(element.data("tag")) ; 
			if (element.data("tag") != selected){
				element.hide() ; 
			}else{
				element.show();
			}
		}) ; 
		
		$("#witelSelect").val($("#witelSelect option:visible:first").val());
		
});
$('#witelSelect').on('change', function() {
		var selected = $(this).val();
		$("#poolSelect option").each(function(item){
			console.log(selected) ;  
			var element =  $(this) ; 
			console.log(element.data("tag")) ; 
			if (element.data("tag") != selected){
				element.hide() ; 
			}else{
				element.show();
			}
		}) ; 
		
		$("#poolSelect").val($("#poolSelect option:visible:first").val());
		
});
</script>