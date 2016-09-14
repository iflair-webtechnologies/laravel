@extends('admin.layouts.master')

@section('title', 'Index - Vacancy - Villato')
@section('page-header', 'Vacancy Index')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="vacancies-table" class="table table-condensed" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Company</th>
                                <th>Description</th>
                                <th>Function Description</th>
                                <th>Email</th>
                                <th>Education</th>
                                <th>Duration</th>
                                <th>Hours</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ route('admin.vacancy.create') }}" class="btn btn-success pull-right">New Vacancy</a>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div>
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function() {
            var table = $('#vacancies-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.vacancy.data') }}',
                columns: [
                    {data: 'id', name: 'vacancy.id'},
                    {data: 'title', name: 'vacancy.title'},
                    {data: 'companyname', name: 'company.name'},
                    {data: 'description', name: 'vacancy.description', visible: false},
                    {data: 'function_description', name: 'vacancy.function_description', visible: false},
                    {data: 'email', name: 'vacancy.email'},
                    {data: 'education', name: 'vacancy.education'},
                    {data: 'duration', name: 'vacancy.duration'},
                    {data: 'hours', name: 'vacancy.hours'},
                    {data: 'created_at', name: 'vacancy.created_at'},
                    {data: 'updated_at', name: 'vacancy.updated_at'},
                    {data: 'action', name: 'actions', searchable: false, orderable: false, width: "65px"}
                ]
            });

            var colvis = new $.fn.dataTable.ColVis(table, {
                buttonText: 'Select Columns'
            });

            $(colvis.button()).insertBefore('#vacancies-table_filter').addClass('col-sm-3');
        });
    </script>
@stop