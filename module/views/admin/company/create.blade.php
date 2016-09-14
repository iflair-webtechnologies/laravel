@extends('admin.layouts.master')

@section('title', 'New - User - Villato')
@section('page-header', 'New User')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form action="{{ route('admin.company.store') }}" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" name="name" type="text" class="form-control" value="{{ old('name') }}" autofocus>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">E-Mail</label>
                                    <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}">
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
                                    <textarea name="info" id="info" class="form-control" rows="3">{{ old('info') }}</textarea>
                                    @foreach($errors->get('info') as $message)
                                        <span class="help-block">{{ $message }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="extra_info">Extra Info</label>
                                    <textarea name="extra_info" id="extra_info" class="form-control" rows="3">{{ old('extra_info') }}</textarea>
                                    @foreach($errors->get('extra_info') as $message)
                                        <span class="help-block">{{ $message }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="phone">Telephone</label>
                                    <input id="phone" name="phone" type="tel" class="form-control" value="{{ old('phone') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input id="mobile" name="mobile" type="tel" class="form-control" value="{{ old('mobile') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="street">Street</label>
                            <input id="street" name="street" type="text" class="form-control" value="{{ old('street') }}">
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="postal_code">Postal Code</label>
                                    <input id="postal_code" name="postal_code" type="text" class="form-control" value="{{ old('postal_code') }}">
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="region">Region</label>
                                    <select id="region" class="form-control" name="region">
                                        @foreach($regions as $region)
                                            <option value="{{ $region->id }}" {{ old('region') == $region->id ? 'selected' : '' }} >{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input id="website" name="website" type="url" class="form-control" value="{{ old('website') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input id="facebook" name="facebook" type="url" class="form-control" value="{{ old('facebook') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="newsletter" value="1" {{ old('newsletter') == true ? 'checked' : '' }}>
                                Newsletter
                            </label>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ route('admin.company.index') }}" class="btn btn-default">Cancel</a>
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
        $('#region').select2();
    </script>
@stop