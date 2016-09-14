@extends('admin.layouts.master')

@section('title', 'Edit - Region - Villato')
@section('page-header', 'Region - Edit - '.$region->name)

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form action="{{ route('admin.region.update', [$region->id]) }}" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control" value="{{ $region->name }}">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Latitude</label>
                                <input name="latitude" type="text" class="form-control" value="{{ $region->latitude }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Longitude</label>
                                <input name="longitude" type="text" class="form-control"
                                       value="{{ $region->longitude }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Population</label>
                            <input name="population" type="number" class="form-control" value="{{ $region->population }}">
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="active" value="1" {{ $region->active == true ? 'checked' : '' }}>
                                Active
                            </label>
                        </div>

                         <!-- <div class="form-group">
                            <label>Paid</label> -->
                            <?php                                 
                                    // if ($region->priceflag == 'Paid') {
                                    //     $checkvalue = "checked";
                                    // }else{
                                    //     $checkvalue = "";
                                    // }                                
                             ?>
                           <!--  <input name="priceflag" id="priceflag" type="checkbox" <?php //echo $checkvalue ?>>
                        </div>
                        <div class="form-group" id="pricediv">
                            <label>Enter Amount</label>
                            <input name="catprice" type="text" class="form-control" value="<?php //echo $region->catprice; ?>">
                        </div> -->
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ route('admin.region.index') }}" class="btn btn-default">Cancel</a>
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-info pull-right">Update</button>
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