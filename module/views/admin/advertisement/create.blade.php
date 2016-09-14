@extends('admin.layouts.master')

@section('title', 'Advertisement  - Villato')
@section('page-header', 'Advertisement')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form action="{{ route('admin.advertisement.store') }}" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">Name</label>
                            <input id="name" name="name" type="text" class="form-control" value="{{ old('name') }}" autofocus required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" id="image" name="image" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="content">Description</label>
                            <textarea name="content" id="content" class="form-control" rows="3">{{ old('content') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" name="category" id="category">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }} >{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><!-- /.box- body -->
                    <div class="box-footer">
                        <a href="{{ route('admin.advertisement.index') }}" class="btn btn-default">Cancel</a>
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type="hidden" name="company_id" value="<?php echo Auth::user()->id; ?>">
                        <button type="submit" class="btn btn-info pull-right">Create</button>
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div>
    </div>
@stop

@section('script')
    <script>
        $('#category').select2();
        CKEDITOR.replace( 'content' );
        CKEDITOR.config.extraAllowedContent = 'div(*)';
    </script>
@stop