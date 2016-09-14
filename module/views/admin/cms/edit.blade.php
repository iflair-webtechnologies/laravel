@extends('admin.layouts.master')

@section('title', 'Villato - Backoffice - Cms - Update')
@section('page-header', 'Cms - Edit - '.$news->title)

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form action="{{ route('admin.cms.update', [$news->id]) }}" method="post"
                      enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" name="title" type="text" class="form-control" value="{{ $news->title }}" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" id="content" class="form-control" rows="3">{{ $news->content }}</textarea>
                        </div>                       
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ route('admin.cms.index') }}" class="btn btn-default">Cancel</a>
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
        CKEDITOR.replace( 'content' );
        CKEDITOR.config.extraAllowedContent = 'div(*)';

    </script>
@stop