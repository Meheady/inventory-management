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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
