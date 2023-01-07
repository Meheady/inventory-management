@extends('admin.master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <a href="{{route('invoice.all')}}" class="btn btn-success">View All Invoice</a>
                    <br><br>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-center">New Invoice</h4>
                        </div>
                        <div class="card-body">



                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group row mb-1">
                                        <label for="name" class="col-form-label">Invoice No</label>
                                        <div class="col-md-12">
                                            <input type="text"  class="form-control" value="{{ $invoice_no }}" id="invoiceNo" name="invoice_no" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group row mb-1">
                                        <label for="name" class="col-form-label">Date</label>
                                        <div class="col-md-12">
                                            <input type="date" id="date" class="form-control" value="{{ date('Y-m-d') }}" name="date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group row mb-1">
                                        <label for="name" class="col-form-label">Category Name</label>
                                        <div class="col-md-12">
                                            <select class="form-select select2" name="category" id="category">
                                                <option value="" selected disable>---Select Category---</option>
                                                @foreach($category as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group row mb-1">
                                        <label for="name" class="col-form-label">Product Name</label>
                                        <div class="col-md-12">
                                            <select class="form-select select2" name="product" id="product">
                                                <option value="0" selected disable>---Select Product---</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-group row mb-1">
                                        <label for="name" class="col-form-label">Stock</label>
                                        <div class="col-md-12">
                                            <input type="text"  class="form-control" id="stock" name="stock" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group row mb-1">
                                        <label for="name" class="col-form-label"></label>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-info addEvent">Add More</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('purchase.store') }}" method="post">
                                @csrf
                                <table class="table-md table-bordered" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Product Name</th>
                                        <th>PSC/BOX/KG</th>
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
    <script id="template" type="text/x-handlebars-template">

        <tr class="delete_add_more" id="delete_add_more">
            <input type="hidden" name="date[]" value="@{{date}}">
            <input type="hidden" name="purchase_no[]" value="@{{purchase_no}}">
            <input type="hidden" name="supplier_id[]" value="@{{supplier_id}}">

            <td>
                <input type="hidden" name="category_id[]" value="@{{category_id}}">
                @{{category_name}}
            </td>
            <td>
                <input type="hidden" name="product_id[]" value="@{{product_id}}">
                @{{product_name}}
            </td>
            <td>
                <input type="number" value="" class="form-control buy_qty text-right" name="buy_qty[]">
            </td>
            <td>
                <input type="number" value="" class="form-control unit_price text-right" name="unit_price[]">
            </td>
            <td>
                <input type="text" value="" class="form-control description text-right" name="description[]">
            </td>
            <td>
                <input type="number" value="0" readonly class="form-control buying_price text-right" name="buying_price[]">
            </td>
            <td>
                <button type="button" class="btn btn-danger removeEvent">Del</button>
            </td>
        </tr>
    </script>

    <script type="text/javascript">

        $(document).ready(function () {


            $('.addEvent').click(function(){

                const date= $('#date').val();
                const purchase_no= $('#purchaseNo').val();
                const supplier_id= $('#supplier').val();
                const category_id= $('#category').val();
                const category_name= $('#category').find('option:selected').text();
                const product_id= $('#product').val();
                const product_name= $('#product').find('option:selected').text();

                if (!date ||!purchase_no ||!supplier_id ||!category_id ||!category_name ||!product_id ||!product_name){
                    $.notify("All field are required",{globalPosition:'top center',class:'error'});
                    return false;
                }
                const source = $("#template").html();
                const template = Handlebars.compile(source);

                const data ={
                    date:date,
                    purchase_no:purchase_no,
                    supplier_id:supplier_id,
                    category_id:category_id,
                    category_name:category_name,
                    product_id:product_id,
                    product_name:product_name
                }
                const html = template(data);
                $("#addRow").append(html);

            })

            $(document).on('click','.removeEvent',function(event){
                $(this).closest('.delete_add_more').remove();
                totalPrice();
            });

            $(document).on('keyup click','.buy_qty,.unit_price',function () {
                const unitPrice = $(this).closest('tr').find('input.unit_price').val();
                const qty = $(this).closest('tr').find('input.buy_qty').val();
                const total = unitPrice * qty;
                $(this).closest('tr').find('input.buying_price').val(total);
                totalPrice();
            })


            function totalPrice () {
                let sum = 0;
                $('.buying_price').each(function () {
                    const value = $(this).val();
                    if (!isNaN(value) && value.length != 0){
                        sum += parseFloat(value);
                    }
                })

                $(".est_amount").val(sum);
            }

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

            $('#product').change(function () {

                var id = $(this).val();
                $.ajax({
                    url: "{{route('get-product-stock')}}",
                    type:"GET",
                    dataType:"json",
                    data:{
                        id:id,
                    },
                    success: function (res) {
                        $('#stock').val(res);
                    }
                })

            })
        })
    </script>
@endsection
