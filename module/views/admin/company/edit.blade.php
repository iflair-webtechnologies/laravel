@extends('admin.layouts.master')

@section('title', 'Edit - Users - Villato')
@section('page-header', 'Users - Edit - '.$company->name)

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form action="{{ route('admin.company.update', [$company->id]) }}" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" name="name" type="text" class="form-control" value="{{ $company->name }}" autofocus>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">E-Mail</label>
                                    <input id="email" name="email" type="email" class="form-control" value="{{ $company->email }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" name="password" type="password" class="form-control" value="{{ old('password') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="info">Info</label>
                                    <textarea name="info" id="info" class="form-control" rows="3">{{ $company->info }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="extra_info">Extra Info</label>
                                    <textarea name="extra_info" id="extra_info" class="form-control" rows="3">{{ $company->extra_info }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="phone">Telephone</label>
                                    <input id="phone" name="phone" type="tel" class="form-control" value="{{ $company->phone }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input id="mobile" name="mobile" type="tel" class="form-control" value="{{ $company->mobile }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="street">Street</label>
                            <input id="street" name="street" type="text" class="form-control" value="{{ $company->street }}">
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="postal_code">Postal Code</label>
                                    <input id="postal_code" name="postal_code" type="text" class="form-control" value="{{ $company->postal_code }}">
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="region">Region</label>
                                    <select id="region" multiple required class="form-control"  name="region[]">
                                        @foreach($regions as $region)
                                            <?php 
                                      if(in_array($region->id, $comregions)) {
                                                $select = 'selected="selected"';
                                            }else{
                                                  $select = '';  
                                            }
                                        ?>
                                            <option  <?php echo $select;?> value="{{ $region->id }}" >{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input id="website" name="website" type="url" class="form-control" value="{{ $company->website }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input id="facebook" name="facebook" type="url" class="form-control" value="{{ $company->facebook }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="newsletter" value="1" {{ $company->newsletter == true ? 'checked' : '' }}>
                                Newsletter
                            </label>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ route('admin.company.index') }}" class="btn btn-default">Cancel</a>
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
        //$('#region').select2();
        $("#region").chosen(
                {
                        no_results_text: "Niets gevonden",                        
                });  
    </script>
@stop