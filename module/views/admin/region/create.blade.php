@extends('admin.layouts.master')

@section('title', 'New - Region - Villato')
@section('page-header', 'New Region')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form action="{{ route('admin.region.store') }}" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Latitude</label>
                                <input name="latitude" type="text" class="form-control" value="{{ old('latitude') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Longitude</label>
                                <input name="longitude" type="text" class="form-control" value="{{ old('longitude') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Population</label>
                            <input name="population" type="number" class="form-control" value="{{ old('population') }}">
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="active" value="1" {{ old('active') == true ? 'checked' : '' }}>
                                Active
                            </label>
                       </div>
                       <!--  <div class="form-group">
                            <label>Paid</label>                           
                            <input name="priceflag" id="priceflag" type="checkbox">
                        </div>
                        <div class="form-group" id="pricediv">
                            <label>Enter Amount</label>
                            <input name="catprice" type="text" class="form-control" value="">
                        </div> -->
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ route('admin.region.index') }}" class="btn btn-default">Cancel</a>
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <button type="submit" class="btn btn-info pull-right">Create</button>
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div>
    </div>
@stop
@section('script')
    <script>
        $(document).ready(function() {
                    if($("#priceflag"). prop("checked") == true){
                                    $("#pricediv").slideDown();        
                                }
                        else if($("#priceflag"). prop("checked") == false){
                                    $("#pricediv").slideUp();
                                }

                    $('#priceflag').change(function(){
                        if($(this). prop("checked") == true){
                                    $("#pricediv").slideDown();        
                                }
                        else if($(this). prop("checked") == false){
                                    $("#pricediv").slideUp();
                                }
                    });
             });
    </script>
@stop  