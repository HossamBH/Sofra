@extends('layouts.app')
@section('content')
    <section class="content">



        <div class="box box-primary">
            <div class="box-body">

                <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i>Order Details {{$order->id}}
                                <small class="pull-left"><i class="fa fa-calendar-o"></i>{{$order->created_at}}
                                </small>
                            </h2>
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            Ordered By: {{$order->client->name}}
                            <address>
                              Phone Number:{{$order->client->phone}}                        
                              <br>
                              Email Address: {{$order->client->email}}
                              <br>
                              Adress:{{$order->client->neighborhood->city->name}}
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>Restaurant Name:{{$order->restaurant->name}} </strong>
                                <br>
                                <strong>Address: {{$order->restaurant->neighborhood->name}}</strong>
                                <br>
                                <strong>Phone Number: {{$order->restaurant->phone}}</strong>
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            
                                <Strong>Order No. {{$order->id}}</Strong>
                                
                            </b><br>
                            <b>Order Details: {{$order->notes}}</b><br>

                            <b>  Status:
                                <i>{{$order->order_state}}</i>
                            </b><br>
                            
                            <b>  Total Price:{{$order->total_price}}
                            </b>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Notes</th>
                                </tr>
                                </thead>
                                <tbody>
                                  @foreach($order->products as $product)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->pivot->quantity}}</td>
                                    <td>{{$product->pivot->price}}</td>
                                    <td>{{$product->pivot->notes}}</td>

                                </tr>
                                <tr>
                                    <td>--</td>
                                    <td>Delivery</td>
                                    <td>-</td>
                                    <td>{{$order->delivery}}  Pound</td>
                                    <td></td>
                                </tr>
                                <tr class="bg-success">
                                    <td>--</td>
                                    <td>Total</td>
                                    <td>-</td>
                                    <td>
                                        {{$order->total_price}}  Pound
                                    </td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                            @endforeach
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <a href="" class="btn btn-default" id="print-all">
                                <i class="fa fa-print"></i> Print </a>

                            <script>
                                //                                $('#myModal').on('shown.bs.modal', function () {
                                //                                    $('#myInput').focus()
                                //                                })
                            </script>
                        </div>
                    </div>
                </section><!-- /.content -->
                <div class="clearfix"></div>

            </div>
        </div>


    </section>

@endsection


