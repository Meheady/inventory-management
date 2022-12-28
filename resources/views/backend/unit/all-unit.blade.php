@extends('admin.master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" data-toggle="modal" data-target="#addunit" class="btn btn-success">Add Unit</button>
                            <br><br>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
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
                                            <button data-toggle="modal" class="btn btn-success edit" data-id="{{ $item->id }}" data-target="#editunit">Edit</button>
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

    <div class="modal fade" id="addunit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-2 text-center">
                    <h5 class="modal-title" id="exampleModalLabel">Add Unit</h5>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('unit.store') }}">
                        @csrf
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
    <div class="modal fade" id="editunit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-2 text-center">
                    <h5 class="modal-title" id="exampleModalLabel">Add Unit</h5>
                </div>
                <div class="modal-body">
                    <form class="editUnit" method="post" action="{{ route('unit.update') }}">
                        @csrf
                        <input type="hidden" class="form-control" id="hidden" name="id">
                        <div class="form-group row mb-1">
                            <label for="name" class="col-form-label col-md-3">Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="namee" name="name">
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
            $(".edit").click(function(){
                var getId = $(this).data('id');
                $('#pageLoader').show();
                $.ajax({
                    url: "/admin/unit/edit/"+getId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {

                        console.log(res);
                        $("#namee").val(res.name);
                        $('#hidden').val(res.id);

                        if (res.status === 1){
                            $("#activee").prop('checked', true);

                        }
                       if (res.status === 0){
                            $("#inactivee").prop('checked', true);

                        }
                        $('#pageLoader').hide();
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
                            url: "/admin/unit/delete/"+getId,
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
