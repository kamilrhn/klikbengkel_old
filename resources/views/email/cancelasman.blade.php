<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>PT. Surya Cakra Buana | Permohonan Approval Cancel Service</title>
   <!-- Tell the browser to be responsive to screen width -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- Bootstrap 4 -->
   <!-- Font Awesome -->
   <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
   <!-- Ionicons -->
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <!-- Theme style -->
   <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
   <!-- Google Font: Source Sans Pro -->
   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
   <section class="content">
      <div class="container-fluid">
         <p>
             Dear Asman Area {{$area->kode_area}},<br><br>
             Dispatcher {{$service->pool}} melakukan Request Cancel Service pada No. Service <strong>{{$service->no_service}}</strong>
             mohon untuk ditindaklanjuti di Website <a href="klikbengkel.id" target="_blank">klikbengkel, </a>
             atau dapat <a href="http://klikbengkel.id/public/service/appcancel-detail/{{$service->no_service}}">klik disini.</a> Status Service tersebut saat ini adalah adalah <strong>{{$service->status}}</strong>.<br><br>
             Terima Kasih.
         </p>
      </div>
   </section>
   <script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>
</body>
