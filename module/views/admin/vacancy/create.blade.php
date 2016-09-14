@extends('admin.layouts.master')

@section('title', 'New - Vacancy - Villato')
@section('page-header', 'New Vacancy')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form action="{{ route('admin.vacancy.store') }}" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" name="title" type="text" class="form-control" value="{{ old('title') }}" autofocus>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="function_description">Function Description</label>
                                    <textarea name="function_description" id="function_description" class="form-control" rows="3">{{ old('function_description') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="education">Education</label>
                            <input id="education" name="education" type="text" class="form-control" value="{{ old('education') }}">
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input id="duration" name="duration" type="text" class="form-control" value="{{ old('duration') }}">
                        </div>
                        <div class="form-group">
                            <label for="hours">Hours</label>
                            <input id="hours" name="hours" type="text" class="form-control" value="{{ old('hours') }}">
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
                        <a href="{{ route('admin.vacancy.index') }}" class="btn btn-default">Cancel</a>
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