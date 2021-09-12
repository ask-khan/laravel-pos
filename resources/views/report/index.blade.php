@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="containner">
                <div class="col">
                    <div class="row">
                        <h5>Select Sales</h5>
                    </div>
                    <div class="row">
                        <select class="js-states form-control" id="report_name" name="state">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
            </div>
            <div id="selected-sales" class="containner pt-4">
                <div id="daily-sales" class="p-2 col-md-12 border bg-white rounded-sm">
                    <button id="daily-sales-button" type="button" class="btn btn-primary"> Generate Daily Report </button>
                </div>
                <div id="monthly-sales" class="p-2 col-md-12 border bg-white rounded-sm">
                    <div class="row">
                        <div class="col from-date">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">From Date</label>
                                <input type="text" placeholder="from Date" class="form-control" id="fromdatepicker">
                            </div>
                        </div>
                        <div class="col to-date">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">From Date</label>
                                <input type="text" placeholder="To Date" class="form-control" id="todatepicker">
                            </div>
                        </div>
                        <div class="col from date">
                            <button id="monthly-sales-button" type="button" class="btn btn-primary"> Generate Report </button>
                        </div>
                    </div>
                </div>
                <div id="customer-sales" class="p-2 col-md-12 border bg-white rounded-sm">
                    <div class="row">
                        <div class="col">
                            <select class="js-states form-control" id="customer_list" name="state">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col from date">
                            <button id="customer-sales-button" type="button" class="btn btn-primary"> Generate Report </button>
                        </div>
                    </div>
                </div>    
            </div>
            
        </div>
    </div>
</div>
@endsection

@push('ajax_crud')
   <script src="/js/sweetalert.js"></script>
   <script src="/js/report.js"></script>
@endpush
