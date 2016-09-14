@extends('admin.layouts.master')

@section('title', 'Index - CMS - Villato')
@section('page-header', 'Cms Index')

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
                <!-- <div class="box-footer">
                    <a href="{{ route('admin.cms.create') }}" class="btn btn-success pull-right">Create Cms</a>
                </div> --><!-- /.box-footer -->
            </div><!-- /.box -->
        </div>
    </div>
    <style type="text/css">
    .btn-danger{
        display: none;
    }
    </style>
@stop

@section('script')
    <script>
        $(document).ready(function() {
            var table = $('#news-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.cms.data') }}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'content', name: 'content', visible: false},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
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