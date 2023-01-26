@extends('admin.master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Customer Invoice</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Customer Invoice</li>
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
                            <a href="{{ route('customer.credit') }}" class="btn btn-success">Back Customer Credit</a>
                            <div class="row">
                                <div class="col-12">
                                    <div class="invoice-title">
                                        <h4 class="float-end font-size-16"><strong>Invoice No # {{ $payment->invoice->invoice_no }}</strong></h4>
                                        <h3>
                                            <img src="{{ asset('/admin') }}/assets/images/logo-sm.png" alt="logo" height="24"/>
                                        </h3>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6 mt-4">
                                        </div>
                                        <div class="col-6 mt-4 text-end">
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
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>{{ $payment->customer->name }}</td>
                                                        <td class="text-center">{{ $payment->customer->phone }}</td>
                                                        <td class="text-center">{{ $payment->customer->email }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <form action="{{ route('update.customer.invoice',$payment->invoice_id) }}" method="post">
                                                @csrf

                                                <table class="table table-responsive">
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
                                                    @foreach($invoiceDetails as $item)
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
                                                        <input type="hidden" name="new_paid_amount" value="{{$payment->due_amount}}">
                                                        <td class="text-center">{{ $payment->due_amount }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6" class="text-center">Grand Total Amount</td>
                                                        <td class="text-center">{{ $payment->total_amount }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label for="">Paid Status</label>
                                                        <select name="paid_status" class="form-select" id="paid_status">
                                                            <option value="" selected disable>Select status</option>
                                                            <option value="full_paid">Full Paid</option>
                                                            <option value="partial_paid">partial Paid</option>
                                                        </select>
                                                        <input placeholder="Enter paid amount" style="display: none" type="text" class="form-control mt-1 paid_amount" name="paid_amount" id="paid_amount">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <div class="md-3">
                                                            <label for="example-text-input" class="form-label">Date</label>
                                                            <input class="form-control example-date-input" name="date" type="date" value="{{date('Y-m-d')}}" id="date">
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <div class="md-3" style="padding-top: 30px;">
                                                            <button type="submit" class="btn btn-info">Invoice Update</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </form>

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
            $('#paid_status').change(function(){
                var status = $(this).val();
                if(status == 'partial_paid'){
                    $('#paid_amount').show();
                }else{
                    $('#paid_amount').hide();
                }
            })
        })
    </script>
@endsection


