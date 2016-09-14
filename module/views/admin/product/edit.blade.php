@extends('admin.layouts.master')
@section('title', 'Edit - Product - Villato')
@section('page-header', 'Product - Edit - '.$product->name)
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form action="{{ route('admin.product.update', [$product->id]) }}" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control" value="{{ $product->name }}">
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select id="category" multiple required class="form-control" name="category[]">
                                @foreach($categories as $category)
                                <?php 
                                      if(in_array($category->id, $procategory)) {
                                                $select = 'selected="selected"';
                                            }else{
                                                  $select = '';  
                                            }
                                        ?>
                                    <option <?php echo $select;?> value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ route('admin.product.index') }}" class="btn btn-default">Cancel</a>
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
        
         $("#category").chosen(
                {
                        no_results_text: "Niets gevonden",                        
                });      
    </script>
@stop