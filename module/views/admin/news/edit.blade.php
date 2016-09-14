@extends('admin.layouts.master')

@section('title', 'Villato - Backoffice - News - Update')
@section('page-header', 'News - Edit - '.$news->title)

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form action="{{ route('admin.news.update', [$news->id]) }}" method="post"
                      enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" name="title" type="text" class="form-control" value="{{ $news->title }}" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" id="image" name="image" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3">{{ $news->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" id="content" class="form-control" rows="3">{{ $news->content }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="company">Company</label>
                            <select id="company" class="form-control" name="company">
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ $news->company->id == $company->id ? 'selected' : '' }} >{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ route('admin.news.index') }}" class="btn btn-default">Cancel</a>
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
        $('#company').select2();
    </script>
@stop