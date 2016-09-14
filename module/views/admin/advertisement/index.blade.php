@extends('admin.layouts.master')

@section('title', 'Index - Advertisement - Villato')
@section('page-header', 'Advertisement Index')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="news-table" class="table table-condensed" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Slug</th>
                                <th>Content</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ route('admin.advertisement.create') }}" class="btn btn-success pull-right">New advertisement</a>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div>
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function() {
            var table = $('#news-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.advertisement.data') }}',
                columns: [
                    {data: 'id', name: 'advertisement.id'},
                    {data: 'companyname', name: 'company.name'},
                    {data: 'categoryname', name: 'categoryadvt.name'},
                    {data: 'slug', name: 'advertisement.slug'},
                    {data: 'content', name: 'advertisement.content', visible: false},
                    {data: 'created_at', name: 'advertisement.created_at'},
                    {data: 'updated_at', name: 'advertisement.updated_at'},
                    {data: 'action', name: 'actions', searchable: false, orderable: false, width: "65px"}
                ]
            });

            var colvis = new $.fn.dataTable.ColVis(table, {
                buttonText: 'Select Columns'
            });

            $(colvis.button()).insertBefore('#news-table_filter').addClass('col-sm-3');
        });
    </script>
@stop