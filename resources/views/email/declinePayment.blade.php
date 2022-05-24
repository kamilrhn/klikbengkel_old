<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>PT. Surya Cakra Buana | Informasi Payment</title>
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
             Dear Dispatcher {{$pool->pool}},<br><br>
             Payment dengan No. Payment {{$payment->kode_bayar}} ditolak oleh Pihak SCB, silahkan cek kembali dan ajukan kembali.<br><br>
             Terima Kasih.
         </p>
      </div>
   </section>
   <script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>
</body>
