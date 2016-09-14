@extends('admin.layouts.master')

@section('title', 'Villato - Backoffice - Advertisement - Update')
@section('page-header', 'Advertisement - Edit - '.$advertisement->name)

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form action="{{ route('admin.advertisement.update', [$advertisement->id]) }}" method="post"
                      enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" name="name" type="text" class="form-control" value="{{ $advertisement->name }}" autofocus required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" id="image" name="image" value="<?php echo $imgurl; ?>" class="form-control"/>
                            <input type="hidden" id="imgstatus" name="imgstatus">
                            <?php //echo $imgurl; ?>
                        </div>   
                        <?php if (!empty($imgurl)) {?>
                            <div class="form-group">
                            <img src="<?php echo $imgsrc; ?>" height='50px' width='50px'>
                            <a href="javascript:;" class="btn btn-default" id='removeimg'>Remove</a>
                        </div>                      

                        <?php } ?>
                        
                        <div class="form-group">
                            <label for="content">Description</label>
                            <textarea name="content" id="content" class="form-control" rows="3">{{ $advertisement->content }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="category">category</label>
                            <select id="category" class="form-control" name="category">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $advertisement->categoryadvt_id == $category->id ? 'selected' : '' }} >{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ route('admin.advertisement.index') }}" class="btn btn-default">Cancel</a>
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="company_id" value="<?php echo Auth::user()->id; ?>">
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
        CKEDITOR.replace( 'content' );
        CKEDITOR.config.extraAllowedContent = 'div(*)';
        jQuery('#removeimg').click(function () {
           jQuery('#imgstatus').val('yes');
           jQuery(this).siblings().remove();
        });
    </script>
@stop