@extends('admin.master');
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" data-toggle="modal" data-target="#addCategory" class="btn btn-success">Add Category</button>
                            <br><br>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Category Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($allData as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->status == 1 ?'Active':'Inactive'}}</td>
                                        <td>
                                            <button data-toggle="modal" class="btn btn-success edit" data-id="{{ $item->id }}" data-target="#editCategory">Edit</button>
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

    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="addCategory" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-2 text-center">
                    <h5 class="modal-title" id="addCategory">Add Category</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('category.store') }}" method="post">
                        @csrf
                        <div class="form-group row mb-1">
                            <label class="col-form-label col-md-3">Category Name</label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-form-label col-md-3">Status</label>
                            <div class="col-md-9">
                                <label>Active<input type="radio" name="status" value="1"></label>
                                <label>Inactive<input type="radio" name="status" value="0"></label>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-form-label col-md-3"></label>
                            <div class="col-md-9">
                                <button type="submit" name="save" class="btn btn-success btn-block">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="editCategory" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-2 text-center">
                    <h5 class="modal-title" id="editCategory">Update Category</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('category.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="upid" id="upid">
                        <div class="form-group row mb-1">
                            <label class="col-form-label col-md-3">Category Name</label>
                            <div class="col-md-9">
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-form-label col-md-3">Status</label>
                            <div class="col-md-9">
                                <label>Active<input type="radio" id="active" name="status" value="1"></label>
                                <label>Inactive<input type="radio" id="inactive" name="status" value="0"></label>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-form-label col-md-3"></label>
                            <div class="col-md-9">
                                <button type="submit" name="update" class="btn btn-success btn-block">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.edit').click(function () {
                var id = $(this).data('id');
                $('#pageLoader').show();
                $.ajax({
                    url: '/admin/category/edit/'+id,
                    type:'GET',
                    dataType:'json',
                    success: function (res) {
                        $('#pageLoader').hide();
                        $('#name').val(res.name);
                        $('#upid').val(res.id);
                        if(res.status == 1){
                            $('#active').prop('checked',true)
                        }
                        if(res.status == 0){
                            $('#inactive').prop('checked',true)
                        }
                    }
                });
            })
        });
    </script>
@endsection
