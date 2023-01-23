@extends('admin.master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h3 class="text-center pt-2">Supplier and product wise Stock Report</h3>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <strong>Supplier wise report</strong>
                                    <input type="radio" name="supplier_product_wise" value="supplier_wise" class="search_value" id="">
                                  <strong>Product wise report</strong>
                                    <input type="radio" name="supplier_product_wise" value="product_wise" class="search_value" id="">
                                </div>
                            </div>
                            <div class="show-supplier">
                                <form action="{{ route('supplier.wise.pdf') }}" target="_blank" method="get">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="">Supplier Name</label>
                                            <select required name="supplier_name" id="" class="form-select select2">
                                                <option value="" selected disabled>Select supplier</option>
                                                @foreach($supplier as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mt-4">
                                            <button type="submit" class="btn btn-info">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="show-product">
                                <form action="{{ route('product.wise.pdf') }}" target="_blank" method="get">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Category Name</label>
                                            <select required name="category_name" id="category" class="form-select select2">
                                                <option value="" selected disabled>Select Category</option>
                                                @foreach($category as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Product Name</label>
                                            <select required name="product_name" id="product" class="form-select select2">
                                            </select>
                                        </div>
                                        <div class="col-md-4 mt-4">
                                            <button type="submit" class="btn btn-info">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
            $('.show-supplier').hide();
            $('.show-product').hide();
            $('.search_value').change(function () {
                var val = $(this).val();
                if (val === 'supplier_wise'){
                    $('.show-supplier').show();
                    $('.show-product').hide();
                }
                else if(val === 'product_wise'){
                    $('.show-supplier').hide();
                    $('.show-product').show();
                }
            });
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
        });
    </script>
@endsection


