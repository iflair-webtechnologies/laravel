@extends('admin.layouts.master')

@section('title', 'New - News - Villato')
@section('page-header', 'New News')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form action="{{ route('admin.news.store') }}" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" name="title" type="text" class="form-control" value="{{ old('title') }}" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" id="image" name="image" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" id="content" class="form-control" rows="3">{{ old('content') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="company">Company</label>
                            <select class="form-control" name="company" id="company">
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('company') == $company->id ? 'selected' : '' }} >{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><!-- /.box- body -->
                    <div class="box-footer">
                        <a href="{{ route('admin.news.index') }}" class="btn btn-default">Cancel</a>
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
        $('#company').select2();
    </script>
@stop