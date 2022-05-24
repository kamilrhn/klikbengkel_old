<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>PT. Surya Cakra Buana | Permohonan Approval</title>
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
             Dear Dispatcher {{$pool->pool}},<br><br><br>
             Request service anda dengan No. Service <strong>{{$service->no_service}}</strong>
             {{$status}} oleh Asman Area {{$service->area}}.<br><br>
             @if($service->status == 'On Service')
             Mobil dengan Nopol {{$service->nopol}} dapat di service di bengkel {{$service->bengkel}}.<br><br><br>
             @elseif($service->status == 'Decline')
             Request dapat dilakukan kembali di menu <strong>Request Service</strong> pada Website
             <a href="klikbengkel.id">Klikbengkel.</a><br><br><br>
             @endif
             Terima Kasih.
         </p>
      </div>
   </section>
   <script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>
</body>
