@extends('admin.master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('invoice.all') }}" class="btn btn-success">All Invoice</a>
                            <br><br>
                            <div class="card-header">
                                <h4 class="text-center">Pending Invoice</h4>
                            </div>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Customer Name</th>
                                    <th>Invoice No</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($allData as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item['payment']['customer']['name']  }}</td>
                                        <td>#{{ $item['invoice_no'] }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            @if($item->status == '0')
                                                <span class="btn btn-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>

                                            <a href="{{ route('invoice.approve',['id'=>$item->id]) }}" class="btn btn-info approve">Approve</a>
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
                            url: "/admin/invoice/delete/"+getId,
                            type: 'GET',
                            dataType: 'json',
                            success: function(res) {
                                parent.slideUp(300, function () {
                                    parent.closest("tr").remove();
                                    window.location.href = res.url;
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


