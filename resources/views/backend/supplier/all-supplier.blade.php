@extends('admin.master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" data-toggle="modal" data-target="#addsupplier" class="btn btn-success">Add Supplier</button>
                            <br><br>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($allData as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->address}}</td>
                                    <td>{{$item->status == 1 ?'Active':'Inactive'}}</td>
                                    <td>
                                        <button data-toggle="modal" class="btn btn-success edit" data-id="{{ $item->id }}" data-target="#editsupplier">Edit</button>
                                        <a href="{{ $item->id }}" class="btn btn-danger">Del</a>
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

    <div class="modal fade" id="addsupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <h5 class="modal-title" id="exampleModalLabel">Add Supplier</h5>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('supplier.store') }}">
                        @csrf
                        <div class="form-group row mb-1">
                            <label for="name" class="col-form-label col-md-3">Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="phone" class="col-form-label col-md-3">Phone</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="phone" name="phone">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="email" class="col-form-label col-md-3">Email</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="address" class="col-form-label col-md-3">Address</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="status" class="col-form-label col-md-3">Status</label>
                            <div class="col-md-9">
                                <label>Active<input type="radio" class="form-check-input" id="active" value="1"  name="status"></label>
                                <label>Inactive<input type="radio" class="form-check-input" id="inactive" value="0"  name="status"></label>
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
    <div class="modal fade" id="editsupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <h5 class="modal-title" id="exampleModalLabel">Add Supplier</h5>
                </div>
                <div class="modal-body">
                    <form class="editSupplier" method="post" action="{{ route('supplier.update') }}">
                        @csrf
                        <input type="hidden" class="form-control" id="hidden" name="id">
                        <div class="form-group row mb-1">
                            <label for="name" class="col-form-label col-md-3">Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="namee" name="name">
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
                                <label>Active<input type="radio" class="form-check-input" id="activee" value="1"  name="statuse"></label>
                                <label>Inactive<input type="radio" class="form-check-input" id="inactivee" value="0"  name="statuse"></label>
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
            $(".edit").click(function(){
                var getId = $(this).data('id');

                $.ajax({
                    url: "/admin/supplier/edit/"+getId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        console.log(res);
                        $("#namee").val(res.name);
                        $('#phonee').val(res.phone);
                        $('#addresse').val(res.address);
                        $('#emaile').val(res.email);
                        $('#hidden').val(res.id);

                        if (res.status == 1){
                            $("#activee").attr('checked', true);
                        }
                        else{
                            $("#inactivee").attr('checked', true);
                        }
                    }
                });
            });
        });
    </script>
@endsection


