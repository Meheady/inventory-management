@extends('admin.master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @php
                            $totalProfit = 0;
                            $totalLoss = 0;
                        @endphp
                        <h3 class="text-center pt-2">Product Wise Profit Report</h3>
                        <div class="card-body">
                            <a href="{{ route('stock.report.pdf') }}" target="_blank" class="btn btn-success">Print Report</a>
                            <br><br>

                            <br><br>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Supplier</th>
                                    <th>Category</th>
                                    <th>Unit</th>
                                    <th>Product Name</th>
                                    <th>Buying Price</th>
                                    <th>Selling Price</th>
                                    <th>Profit/Loss</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($allData as $item)
                                    @php
                                        $buying_total = App\Models\Purchase::where('category_id',$item->category_id)->where('product_id',$item->id)->where('status','1')->sum('buying_qty');
                                        $buying_price = App\Models\Purchase::where('category_id',$item->category_id)->where('product_id',$item->id)->where('status','1')->sum('unit_price');
                                        $selling_total = App\Models\detailsInvoice::where('category_id',$item->category_id)->where('product_id',$item->id)->where('status','1')->sum('selling_qty');
                                        $selling_price = App\Models\detailsInvoice::where('category_id',$item->category_id)->where('product_id',$item->id)->where('status','1')->sum('unit_price');
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->supplier? $item->supplier->name:'' }}</td>
                                        <td>{{ $item->category? $item->category->name:'' }}</td>
                                        <td>{{ $item->unit? $item->unit->name:'' }}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$buying_price}}</td>
                                        <td>{{$selling_price}}</td>
                                        @if($selling_price - $buying_price < 0)
                                            @php
                                            $totalL = $selling_price - $buying_price;
                                                $totalLoss += $totalL;
                                            @endphp
                                            <td><button class="btn btn-danger btn-block">{{$selling_price - $buying_price}}</button></td>
                                        @else
                                            @php
                                            $totalP = $selling_price - $buying_price;
                                                $totalProfit += $totalP;
                                            @endphp
                                            <td><button class="btn btn-success btn-block">{{$selling_price - $buying_price}}</button></td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                                <h4>
                                    <strong>Profit </strong> <button class="btn btn-success"> {{ $totalProfit }}</button>
                                    <strong>Loss </strong> <button class="btn btn-danger"> {{ $totalLoss }}</button>
                                </h4>
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
