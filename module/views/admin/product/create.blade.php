@extends('admin.layouts.master')

@section('title', 'New - Product - Villato')
@section('page-header', 'New Product')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form action="{{ route('admin.product.store') }}" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select id="category" multiple class="form-control" name="category[]">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }} >{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>                        
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ route('admin.product.index') }}" class="btn btn-default">Cancel</a>
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
    $("#category").chosen(
                {
                        no_results_text: "Niets gevonden",                        
                });      
    </script>
@stop  