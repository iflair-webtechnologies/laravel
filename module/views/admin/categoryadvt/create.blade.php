@extends('admin.layouts.master')

@section('title', 'New - Advertisement Category - Villato')
@section('page-header', 'New Advertisement Category')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form action="{{ route('admin.categoryadvt.store') }}" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control" value="{{ old('name') }}" required>
                        </div>                        
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ route('admin.categoryadvt.index') }}" class="btn btn-default">Cancel</a>
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <button type="submit" class="btn btn-info pull-right">Create</button>
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div>
    </div>
@stop