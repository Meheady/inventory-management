@extends('admin.master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h3 class="text-center pt-2">All Stock Report</h3>
                        <div class="card-body">
                            <a href="{{ route('stock.report.pdf') }}" target="_blank" class="btn btn-success">Print Stock Report</a>
                            <br><br>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- supplier modal -->


@endSection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){

        });
    </script>
@endsection


