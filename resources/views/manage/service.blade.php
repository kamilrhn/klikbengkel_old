
@extends('layouts.app')
@section('content')
@include('layouts.headers.adminKendaraan')
<div class="container-fluid mt--7">
   <div class="row">
      <div class="col">
         <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Data Kendaraan PT Graha Sarana Duta</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table table-flush yajra-datatable">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="nopol">Nopol</th>
                    <th scope="col" class="sort" data-sort="area">Area</th>
                    <th scope="col" class="sort" data-sort="witel">Witel</th>
                    <th scope="col" class="sort" data-sort="pool">Pool</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                
                </tbody>
              </table>
            </div>
            
            <!-- Card footer -->
            <div class="card-footer py-4">
              <nav aria-label="...">
                <div class="float-sm-right">
                  <ul class="pagination mb-0">
                    <li class="page-item">
                      
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

@push('js')
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
    $(function () {
      
      var table = $('.yajra-datatable').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
            url: '{!! url()->current() !!}'
          },
          columns: [
              {data: 'nopol', name: 'nopol'},
              {data: 'area', name: 'area'},
              {data: 'witel', name: 'witel'},
              {data: 'pool', name: 'pool'},
              {
                  data: 'action', 
                  name: 'action', 
                  orderable: true, 
                  searchable: true
              },
          ]
      });
      
    });
</script>
@endpush