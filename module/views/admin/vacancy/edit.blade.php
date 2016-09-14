@extends('admin.layouts.master')

@section('title', 'Edit - Vacancy - Villato')
@section('page-header', 'Vacancy - Edit - '.$vacancy->title)

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form action="{{ route('admin.vacancy.update', [$vacancy->id]) }}" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" name="title" type="text" class="form-control" value="{{ $vacancy->title }}" autofocus>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="3">{{ $vacancy->description }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="function_description">Function Description</label>
                                    <textarea name="function_description" id="function_description" class="form-control" rows="3">{{ $vacancy->function_description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" class="form-control" value="{{ $vacancy->email }}">
                        </div>
                        <div class="form-group">
                            <label for="education">Education</label>
                            <input id="education" name="education" type="text" class="form-control" value="{{ $vacancy->education }}">
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input id="duration" name="duration" type="text" class="form-control" value="{{ $vacancy->duration }}">
                        </div>
                        <div class="form-group">
                            <label for="hours">Hours</label>
                            <input id="hours" name="hours" type="text" class="form-control" value="{{ $vacancy->hours }}">
                        </div>
                        <div class="form-group">
                            <label for="company">Company</label>
                            <select id="company" class="form-control" name="company">
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ $vacancy->company->id == $company->id ? 'selected' : '' }} >{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ route('admin.vacancy.index') }}" class="btn btn-default">Cancel</a>
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