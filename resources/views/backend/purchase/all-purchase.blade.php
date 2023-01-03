@extends('admin.master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" data-toggle="modal" data-target="#addPurchase}" class="btn btn-success">New Purchase</button>
                            <br><br>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Purchase No</th>
                                    <th>Supplier</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Qty</th>
                                    <th>Product Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($allData as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $loop->purchase_no }}</td>
                                        <td>{{ $item->supplier? $item->supplier->name:'' }}</td>
                                        <td>{{ $item->category? $item->category->name:'' }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->buying_qty }}</td>
                                        <td>{{$item->product?$item->product->name:''}}</td>
                                        <td>{{$item->status == 1 ?'Approve':'Pending'}}</td>
                                        <td>
                                            <button data-toggle="modal" class="btn btn-success edit" data-id="{{ $item->id }}" data-target="#editPurchase">Edit</button>
                                            <button id="delete"  data-id="{{ $item->id }}" class="btn btn-danger delete">Del</button>
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
@endsection
