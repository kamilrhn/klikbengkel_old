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
             Dear Asman Area {{$area->kode_area}},<br><br>
             Service dengan No. Service <strong>{{$service->no_service}}</strong>
             sudah diselesaikan oleh Dispatcher {{$service->pool}}.<br><br>
             Sehubungan dengan telah selesainya service tersebut, maka kami infokan bahwa telah terbit Invoice dengan No. Invoice <strong>{{$invoice->no_invoice}}</strong>. Untuk invoice dapat dilihat di Aplikasi Klikbengkel atau <a href="http://klikbengkel.id/public/invoice/{{$invoice->no_invoice}}">disini.</a><br><br>
             Terima Kasih.
         </p>
      </div>
   </section>
   <script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>
</body>
