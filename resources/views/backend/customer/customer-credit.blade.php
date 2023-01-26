@extends('admin.master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('customer.credit.pdf') }}" target="_blank" class="btn btn-success">Print Customer Credit</a>

                            <br><br>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Customer Name</th>
                                    <th>Invoice No</th>
                                    <th>Date</th>
                                    <th>Due Amount</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($allData as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$item->customer->name}}</td>
                                        <td>{{$item->invoice->invoice_no}}</td>
                                        <td>{{  date('d-m-Y',strtotime($item->invoice->date)) }}</td>
                                        <td>{{$item->due_amount}}</td>
                                        <td>
                                            <a href="{{route('customer.invoice.edit',$item->invoice_id)}}" class="btn btn-info">Edit Invoice</a>
                                            <a href="{{route('customer.invoice.details',$item->invoice_id)}}" class="btn btn-info">Details Invoice</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- supplier modal -->

    <div class="modal fade" id="editcustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Update Supplier</h5>
                </div>
                <div class="modal-body">
                    <form class="editcustomer" method="post" action="{{ route('customer.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="form-control" id="hidden" name="id">
                        <div class="form-group row mb-1">
                            <label for="name" class="col-form-label col-md-3">Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="namee" name="name">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="name" class="col-form-label col-md-3">Image</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control" id="imagee" name="image">
                                <img src="" id="viewImg" alt="Customer_image" width="40px" height="40px">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="phone" class="col-form-label col-md-3">Phone</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="phonee" name="phone">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="email" class="col-form-label col-md-3">Email</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="emaile" name="email">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="address" class="col-form-label col-md-3">Address</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="addresse" name="address">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="status" class="col-form-label col-md-3">Status</label>
                            <div class="col-md-9">
                                <label>Active<input type="radio" class="form-check-input" id="activee" value="1"  name="status"></label>
                                <label>Inactive<input type="radio" class="form-check-input" id="inactivee" value="0"  name="status"></label>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" name="save" class="btn btn-primary">Save</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

@endSection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){

        });
    </script>
@endsection


