@extends('admin.master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Daily Invoice Report</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Daily Invoice Report</li>
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
                                        <h3>
                                            <img src="{{ asset('/admin') }}/assets/images/logo-sm.png" alt="logo" height="24"/>
                                            My Warehouse ltd
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
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <div class="p-2">
                                            <h3 class="font-size-16"><strong>Daily Invoice Report From -> {{ date('d-m-Y',strtotime($sdate)) }} To {{ date('d-m-Y',strtotime($enddate)) }}</strong></h3>
                                        </div>
                                        <div class="">
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-responsive">
                                                    <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Customer Name</th>
                                                        <th>Invoice No</th>
                                                        <th>Date</th>
                                                        <th>Description</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php
                                                        $total_sum = 0;
                                                    @endphp
                                                    @foreach($allData as $item)
                                                        <tr>
                                                            <td class="text-center">{{$loop->iteration}}</td>
                                                            <td class="text-center">{{ $item->payment->customer->name }}</td>
                                                            <td class="text-center">#{{$item->invoice_no}}</td>
                                                            <td class="text-center" >{{date('d-m-Y',strtotime($item->date))}}</td>
                                                            <td class="text-center">{{$item->description}}</td>
                                                            <td class="text-center">{{$item->payment->total_amount}}</td>
                                                        </tr>
                                                        @php
                                                            $total_sum += $item->payment->total_amount;
                                                        @endphp
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="5" class="text-center">Sub Total</td>
                                                        <td class="text-center">{{ $total_sum }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

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
        })
    </script>
@endsection


