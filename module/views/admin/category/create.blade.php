@extends('admin.layouts.master')

@section('title', 'New - Category - Villato')
@section('page-header', 'New Category')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form action="{{ route('admin.category.store') }}" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Region</label>
                            <select id="regions" multiple name="regions[]" required class="drop-down" data-placeholder="Kies een Regions...">
                                    <option value="0"  >Selecteer uw Region...</option>
                                               <?php foreach ($regions as $key => $value) {?>
                                                      <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="4" value="{{ old('description') }}" required></textarea>
                        </div>                     
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ route('admin.category.index') }}" class="btn btn-default">Cancel</a>
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <button type="submit" class="btn btn-info pull-right">Create</button>
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div>
    </div>
@stop
@section('script')
<script type="text/javascript">
 $(function()
{
    $("#regions").chosen(
    {
        no_results_text: "Niets gevonden",        
    });
     });
 </script>
@stop  