@extends('admin.master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('invoice.pending') }}" class="btn btn-success">View all pending Invoice</a>
                            <br><br>
                          <h4>Invoice No: #{{$invoice->invoice_no}} - {{ date('d-m-Y',strtotime($invoice->date)) }}</h4>

                            <table class="table table-dark" width="100%">
                                <tbody>
                                <tr>
                                    <td><p>Customer Info</p></td>
                                    <td><p>Name: <strong>{{ $payment->customer->name }}</strong></p></td>
                                    <td><p>Mobile: <strong>{{ $payment->customer->name }}</strong></p></td>
                                    <td><p>Email: <strong>{{ $payment->customer->email }}</strong></p></td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                    <p>Description: <strong>{{ $invoice->description }}</strong></p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <form action="">
                                <table border="1" class="table table-dark">
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
                                        <td class="text-center">{{$item->product->quantity}}</td>
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
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {

            $(document).on('click','.delete',function(event){
                var getId = $(this).data('id');
                var parent = $(this).parent();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete This Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#pageLoader').show();
                        $.ajax({
                            url: "/admin/purchase/delete/"+getId,
                            type: 'GET',
                            dataType: 'json',
                            success: function(res) {
                                parent.slideUp(300, function () {
                                    parent.closest("tr").remove();
                                    $('#pageLoader').hide();
                                });
                            }
                        });
                    }
                })

            });
        })
    </script>
@endsection

