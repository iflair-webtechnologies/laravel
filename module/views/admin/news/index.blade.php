@extends('admin.layouts.master')

@section('title', 'Index - News - Villato')
@section('page-header', 'News Index')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="news-table" class="table table-condensed" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Company</th>
                                <th>Description</th>
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
                    <a href="{{ route('admin.news.create') }}" class="btn btn-success pull-right">New News</a>
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
                ajax: '{{ route('admin.news.data') }}',
                columns: [
                    {data: 'id', name: 'news.id'},
                    {data: 'title', name: 'news.title'},
                    {data: 'companyname', name: 'company.name'},
                    {data: 'description', name: 'news.description', visible: false},
                    {data: 'content', name: 'news.content', visible: false},
                    {data: 'created_at', name: 'news.created_at'},
                    {data: 'updated_at', name: 'news.updated_at'},
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