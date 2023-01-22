@extends('admin.master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Stock Report</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Stock Report</li>
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
                                        </div>
                                        <div class="">
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-responsive">
                                                    <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Supplier</th>
                                                        <th>Category</th>
                                                        <th>Unit</th>
                                                        <th>Product Name</th>
                                                        <th>Stock</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($allData as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $item->supplier? $item->supplier->name:'' }}</td>
                                                            <td>{{ $item->category? $item->category->name:'' }}</td>
                                                            <td>{{ $item->unit? $item->unit->name:'' }}</td>
                                                            <td>{{$item->name}}</td>
                                                            <td>{{$item->quantity}}</td>
                                                        </tr>
                                                    @endforeach
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
        })
    </script>
@endsection


