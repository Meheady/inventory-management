@extends('admin.master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <a href="{{route('purchase.all')}}" class="btn btn-success">View All Purchase</a>
                    <br><br>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-center">New Purchase</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group row mb-1">
                                        <label for="name" class="col-form-label col-md-4">Date</label>
                                        <div class="col-md-8">
                                            <input type="date" id="date" class="form-control" name="date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row mb-1">
                                        <label for="name" class="col-form-label col-md-4">Purchase No</label>
                                        <div class="col-md-8">
                                            <input type="text"  class="form-control" name="purchase_no">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row mb-1">
                                        <label for="name" class="col-form-label col-md-4">Supplier Name</label>
                                        <div class="col-md-8">
                                            <select class="form-select" name="supplier" id="supplier">
                                                <option value="" selected disable>---Select Supplier---</option>
                                                @foreach($supplier as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row mb-1">
                                        <label for="name" class="col-form-label col-md-4">Category Name</label>
                                        <div class="col-md-8">
                                            <select class="form-select" name="category" id="category">
                                                <option value="" selected disable>---Select Category---</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row mb-1">
                                        <label for="name" class="col-form-label col-md-4">Product Name</label>
                                        <div class="col-md-8">
                                            <select class="form-select" name="product" id="product">
                                                <option value="" selected disable>---Select Product---</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row mb-1">
                                        <label for="name" class="col-form-label col-md-1"></label>
                                        <div class="col-md-11">
                                            <button type="submit" class="btn btn-info">Add More</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="">
                                @csrf
                                <table class="table-md table-bordered" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Product Name</th>
                                        <th>Unit</th>
                                        <th>Unit Price</th>
                                        <th>Description</th>
                                        <th>Total Price</th>
                                        <th>Action</th>
                                    </tr>
                                    <tbody id="addRow" class="addRow">

                                    </tbody>
                                    <tbody>
                                    <tr>
                                        <td colspan="5"></td>
                                        <td>
                                            <input type="text" name="est_amount" value="0" id="est_amount" class="form-control est_amount" readonly>
                                        </td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                    </thead>
                                </table>
                                <br>
                                <div class="form-group">
                                    <button class="btn btn-info" id="storePurchase">Purchase Now</button>
                                </div>
                            </form>
                        </div>
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
            $('#supplier').change(function () {
                var id = $(this).val();

                $.ajax({
                    url: "{{route('get-category')}}",
                    type:"GET",
                    dataType:"json",
                    data:{
                        id:id,
                    },
                    success:function (res) {
                        var html = '<option value="" selected disable>---Select Category---</option>'
                       $.each(res,function (key,v) {
                           html += '<option value="'+ v.category_id +'">'+ v.category.name +'</option>'
                       })
                        $('#category').html(html);
                    },
                    error:function (err) {
                        console.log(err);
                    }
                })
            })
            $('#category').change(function () {
                var id = $(this).val();

                $.ajax({
                    url: "{{route('get-product')}}",
                    type:"GET",
                    dataType:"json",
                    data:{
                        id:id,
                    },
                    success:function (res) {
                        var html = '<option value="" selected disable>---Select Product---</option>'
                       $.each(res,function (key,v) {
                           html += '<option value="'+ v.id +'">'+ v.name +'</option>'
                       })
                        $('#product').html(html);
                    },
                    error:function (err) {
                        console.log(err);
                    }
                })
            })
        })
    </script>
@endsection
