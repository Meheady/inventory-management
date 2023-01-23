@extends('admin.master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Invoice</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Invoice</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    <div class="invoice-title">
                                        <h4 class="float-end font-size-16"><strong>Order # {{ $invoice->invoice_no }}</strong></h4>
                                        <h3>
                                            <img src="{{ asset('/admin') }}/assets/images/logo-sm.png" alt="logo" height="24"/>
                                        </h3>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6 mt-4">
                                            <address>
                                                <strong>My Warehouse ltd</strong><br>
                                                Uttor badda, Dhaka 1212<br>
                                                warehouse@email.com
                                            </address>
                                        </div>
                                        <div class="col-6 mt-4 text-end">
                                            <address>
                                                <strong>Order Date:</strong><br>
                                                {{$invoice->date}}<br><br>
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <div class="p-2">
                                            <h3 class="font-size-16"><strong>Customer Invoice</strong></h3>
                                        </div>
                                        <div class="">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <td><strong>Customer Name</strong></td>
                                                        <td class="text-center"><strong>Mobile</strong></td>
                                                        <td class="text-center"><strong>Email</strong>
                                                        </td>
                                                        <td class="text-end"><strong>Description</strong></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>{{ $payment->customer->name }}</td>
                                                        <td class="text-center">{{ $payment->customer->phone }}</td>
                                                        <td class="text-center">{{ $payment->customer->email }}</td>
                                                        <td class="text-end">{{ $invoice->description }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table
                                                    class="table table-responsive">
                                                    <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Category</th>
                                                        <th>Product Name</th>
                                                        <th>Current Stock</th>
                                                        <th>Quantity</th>
                                                        <th>Unit Price</th>
                                                        <th>Total Price</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php
                                                        $total_sum = 0;
                                                    @endphp
                                                    @foreach($invoice['invoiceDetails'] as $item)
                                                        <tr>
                                                            <td class="text-center">{{$loop->iteration}}</td>
                                                            <td class="text-center">{{ $item['category']['name'] }}</td>
                                                            <td class="text-center">{{$item->product->name}}</td>
                                                            <td class="text-center" >{{$item->product->quantity}}</td>
                                                            <td class="text-center">{{$item->selling_qty}}</td>
                                                            <td class="text-center">{{$item->unit_price}}</td>
                                                            <td class="text-center">{{$item->selling_price}}</td>
                                                        </tr>
                                                        @php
                                                            $total_sum += $item->selling_price;
                                                        @endphp
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="6" class="text-center">Sub Total</td>
                                                        <td class="text-center">{{ $total_sum }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6" class="text-center">Discount</td>
                                                        <td class="text-center">{{ $payment->discount_amount }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6" class="text-center">Paid Amount</td>
                                                        <td class="text-center">{{ $payment->paid_amount }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6" class="text-center">Due Amount</td>
                                                        <td class="text-center">{{ $payment->due_amount }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6" class="text-center">Grand Total Amount</td>
                                                        <td class="text-center">{{ $payment->total_amount }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            @php
                                                $date = new DateTime('now',new DateTimeZone('Asia/Dhaka'));
                                            @endphp
                                            <i>Printed Time {{ $date->format('d.m.Y, h:i:s') }}</i>
                                            <div class="d-print-none">
                                                <div class="float-end">
                                                    <a href="javascript:window.print()" class="btn btn-md btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> <!-- end row -->

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>


@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            window.print();
        })
    </script>
@endsection


