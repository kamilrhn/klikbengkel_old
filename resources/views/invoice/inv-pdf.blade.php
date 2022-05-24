<html>

   <head>

      <title>Invoice klikbengkel - {{$invoice->no_invoice}}</title>

      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

   </head>

   <body>

      <style type="text/css">

         table tr td,

         table tr th{

         font-size: 9pt;

         }

         .container{

         margin-top:75px;

         }

      </style>

      <div class="container">

         <div class="row">

            <div class="col-lg-6">

               <img src="{{ asset('argon') }}/img/brand/klikbengkel.png" alt="" style="height:100px;width:225px;margin-left:-10px;">

            </div>

            <div class="col-lg-6">

               <div class="float-sm-right">

                  <img src="{{ asset('argon') }}/img/brand/scb.png" alt="" style="height:80px;width:100px;margin-top:-100px;">

               </div>

            </div>

         </div>

         <div class="row mt-4">

            <div class="col-12">

               <div class="card card-primary">

                  <div class="card-body">

                     <h2>

                        <strong>

                           <center>INVOICE</center>

                        </strong>

                     </h2>

                     <h5>

                        <strong>

                           <center>{{$invoice->no_invoice}}</center>

                        </strong>

                     </h5>

                  </div>

               </div>

            </div>

         </div>

         <div class="row invoice-info mt-4">

            <div class="col-sm-4 invoice-col">

               Kepada :

               <address class="mt-2">

                  <strong>PT GRAHA SARANA DUTA AREA {{$invoice->area}}</strong>

               </address>

            </div>
	    <div class="col-sm-4 invoice-col">

               Tanggal Service :

               <address class="mt-2">

                  <strong>{{$invoice->service->tanggal}}</strong>

               </address>

            </div>

<div class="col-sm-4 invoice-col">

               Tempat Service :

               <address class="mt-2">

                  <strong>{{$invoice->service->bengkel}}</strong>

               </address>

            </div>

         </div>

         <div class="row" style="">

            <div class="col-12">

               <div class="table-responsive">

                  <table class="table table-bordered" style="width=100%;">

                     <thead>

                        <tr class="teal darken-1 white-text text-center" style="color:black;font-weight:bolder;background-color:#565656">

                           <th colspan="4">

                              <h4>

                                 <strong>

                                    <center>DETAIL SERVICE</center>

                                 </strong>

                              </h4>

                              <h5 style="font-size:14px;">

                                 <strong>

                                    <center>{{$invoice->no_service}}</center>

                                 </strong>

                              </h5>

                           </th>

                        </tr>

                        <tr class="teal darken-1 white-text text-center" style="color:black;font-weight:bolder;background-color:#565656">

                           <th width="40%">Deskripsi</th>

                           <th width="20%">Qty</th>

                           <th width="20%">Harga</th>

                           <th width="20%">Subtotal</th>

                        </tr>

                     </thead>

                     <tbody>

                        @foreach($invoice->service->rincian as $r)

                        <tr class="text-center">

                           <td width="40%">{{$r->keterangan}}</td>

                           <td width="20%">{{$r->qty}}</td>

                           <td width="20%">{{number_format($r->harga)}}</td>

                           <td width="20%">{{number_format($r->subtotal)}}</td>

                        </tr>

                        @endforeach

                     </tbody>

                     <tfoot>

                        <tr class="teal darken-1 white-text text-center" style="color:black;font-weight:bolder;background-color:#808080">

                           <th colspan="3">Total</th>

                           <th>{{number_format($invoice->service->subtotal)}}</th>

                        </tr>

                        <tr class="teal darken-1 white-text text-center" style="color:black;font-weight:bolder;background-color:#808080">

                           <th colspan="3">PPn(10%)</th>

                           <th>{{number_format($invoice->service->ppn)}}</th>

                        </tr>

                        <tr class="teal darken-1 white-text text-center" style="color:black;font-weight:bolder;background-color:#808080">

                           <th colspan="3">Grand Total</th>

                           <th>{{number_format($invoice->service->total)}}</th>

                        </tr>

                     </tfoot>

                  </table>

               </div>

            </div>

         </div>

      </div>

      <div class="row mt-4" style="margin-right:35px;">

         <div class="col-6" style="font-size:16px;">

         </div>

         <div class="col-6">

            <div class="float-right">

               Authorized By<br><br><br><br><br>

               <b>Arifin Budijanto</b>

            </div>

         </div>

      </div>

   </body>

   <script type="text/javascript"> 

      window.addEventListener("load", window.print());

   </script>

</html>