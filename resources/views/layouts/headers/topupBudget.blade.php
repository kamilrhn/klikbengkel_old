<div class="header pb-8 pt-5 pt-md-8" style="background-color:#ed1c24;">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Topup Budget</h6>
                </div>
                <div class="col-lg-6 col-7">
                    <div class="float-sm-right">
                      @if(Auth::user()->area->budget != null)
                        <a href="#" class="btn btn-sm btn-neutral" data-toggle="modal" data-target="#exampleModal">Topup</a>
                      @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Topup Budget</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('topup.store', Auth::user()->resp)}}" method="POST" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
                <label class="form-control-label" for="input-city">Periode</label>
                <input type="text" name="km" id="input-city" class="form-control" placeholder="Odoometer" value="{{\Carbon\Carbon::now()->format('M Y')}}" readonly>
            </div>
            <div class="form-group">
              <label class="form-control-label" for="input-city">Pilih Pool</label>
              <select name="pool" class="form-control">
                <option value="" selected disabled>Pilih Pool</option>           
                  @foreach($pool as $p)
                  <option value="{{$p->pool}}">{{$p->pool}}</option>
                  @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-control-label" for="input-city">Jumlah Budget(Rp)</label>
                <input type="number" name="budget" id="input-city" class="form-control" placeholder="Masukkan Jumlah Budget">
            </div>
            <div class="form-group">
                <label class="form-control-label" for="input-city">Keterangan</label>
                <textarea name="keterangan" id="input-city" class="form-control"></textarea>
            </div>
      </div>
      <div class="modal-footer mt--2">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" style="background-color:#808080;">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>