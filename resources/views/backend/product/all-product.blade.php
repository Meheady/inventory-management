@extends('admin.master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" data-toggle="modal" data-target="#addProduct" class="btn btn-success add">Add Product</button>
                            <br><br>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Supplier Name</th>
                                    <th>Unit</th>
                                    <th>Category</th>
                                    <th>Product Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($allData as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$item->supplier->name}}</td>
                                        <td>{{$item->unit->name}}</td>
                                        <td>{{$item->category->name}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->status == 1 ?'Active':'Inactive'}}</td>
                                        <td>
                                            <button data-toggle="modal" class="btn btn-success edit" data-id="{{ $item->id }}" data-target="#editProduct">Edit</button>
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

    <!-- supplier modal -->

    <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-2 text-center">
                    <h5 class="modal-title text-center" id="addProduct">Add Product</h5>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('product.store') }}">
                        @csrf
                        <div class="form-group row mb-1">
                            <label class="col-md-3 col-form-label">Select</label>
                            <div class="col-md-9">
                                <select class="form-select addsupplier" name="addsupplier">
                                    <option value="" selected>Select Supplier</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-md-3 col-form-label">Select</label>
                            <div class="col-md-9">
                                <select class="form-select addcategory" name="addcategory">
                                    <option value="" selected>Select Category</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-md-3 col-form-label">Select</label>
                            <div class="col-md-9">
                                <select class="form-select addunit" name="addunit">
                                    <option value="" selected>Select Unit</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="name" class="col-form-label col-md-3">Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control"  name="name">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="status" class="col-form-label col-md-3">Status</label>
                            <div class="col-md-9">
                                <label>Active<input type="radio" class="form-check-input" value="1"  name="status"></label>
                                <label>Inactive<input type="radio" class="form-check-input" value="0"  name="status"></label>
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
    <div class="modal fade" id="editProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Update Product</h5>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('product.update') }}">
                        @csrf
                        <div class="form-group row mb-1">
                            <label class="col-md-3 col-form-label">Select</label>
                            <div class="col-md-9">
                                <select class="form-select editsupplier" name="editsupplier">
                                    <option value="" selected disabled>Select Supplier</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-md-3 col-form-label">Select</label>
                            <div class="col-md-9">
                                <select class="form-select editcategory" name="editcategory">
                                    <option value="" selected disabled>Select Category</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-md-3 col-form-label">Select</label>
                            <div class="col-md-9">
                                <select class="form-select editunit" name="editunit">
                                    <option value="" selected disabled>Select Unit</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="name" class="col-form-label col-md-3">Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="name" name="name">
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

@endSection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){

            $('.add').click(function () {
                $('#pageLoader').show();
                $.ajax({
                    url:'/admin/product/add',
                    type:'GET',
                    dataType:'json',
                    success: function (res) {
                        $('#pageLoader').hide();
                        $.each(res.supplier, function(key, value) {
                           $('select[name="addsupplier"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                        $.each(res.category, function(key, value) {
                           $('select[name="addcategory"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                        $.each(res.unit, function(key, value) {
                           $('select[name="addunit"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    },
                    error: function (err) {
                        console.log(err);
                    }
                })
            })

            $(".edit").click(function(){
                var getId = $(this).data('id');
                $('#pageLoader').show();
                $.ajax({
                    url: "/admin/product/edit/"+getId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        $('#pageLoader').hide();
                        console.log(res);
                        $("#name").val(res.id.name);

                        $.each(res.supplier, function(key, value) {

                            if (value.id == res.id.supplier_id){
                                $('select[name="editsupplier"]').append('<option value="'+ value.id +'" selected>'+ value.name +'</option>');
                            }
                            else{
                                $('select[name="editsupplier"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            }
                        });
                        $.each(res.category, function(key, value) {

                            if (value.id == res.id.category_id){
                                $('select[name="editcategory"]').append('<option value="'+ value.id +'" selected>'+ value.name +'</option>');
                            }
                            else{
                                $('select[name="editsupplier"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            }
                        });
                        $.each(res.unit, function(key, value) {

                            if (value.id == res.id.unit_id){
                                $('select[name="editunit"]').append('<option value="'+ value.id +'" selected>'+ value.name +'</option>');
                            }
                            else{
                                $('select[name="editunit"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            }
                        });

                        if (res.id.status == 1){
                            $("#active").prop('checked', true);
                        }
                        else{
                            $("#inactive").prop('checked', true);
                        }
                    }
                });
            });
            $(".delete").click(function(){
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
                            url: "/admin/customer/delete/"+getId,
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
        });
    </script>
@endsection


