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
                            <h4 class="text-center">Generate Profit loss Report</h4>
                        </div>
                        <div class="card-body">


                            <form action="{{ route('profit.loss.report.pdf') }}" method="get" target="_blank">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group row mb-1">
                                            <label for="name" class="col-form-label">Start Date</label>
                                            <div class="col-md-12">
                                                <input type="date" required id="startdate" class="form-control" value="{{ date('Y-m-d') }}" name="startdate">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row mb-1">
                                            <label for="name" class="col-form-label">End Date</label>
                                            <div class="col-md-12">
                                                <input type="date" required id="enddate" class="form-control" value="{{ date('Y-m-d') }}" name="enddate">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row mt-4">
                                            <label for="name" class="col-form-label"></label>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-info">Show report</button>                                        </div>
                                        </div>
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
@endsection

