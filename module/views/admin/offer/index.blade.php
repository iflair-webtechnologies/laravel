@extends('admin.layouts.master')

@section('title', 'Index - Offer - Villato')
@section('page-header', 'Offer Index')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="offers-table" class="table table-condensed" width="100%">
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
                    <a href="{{ route('admin.offer.create') }}" class="btn btn-success pull-right">New Offer</a>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div>
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function() {
            var table = $('#offers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.offer.data') }}',
                columns: [
                    {data: 'id', name: 'offer.id'},
                    {data: 'title', name: 'offer.title'},
                    {data: 'companyname', name: 'company.name'},
                    {data: 'description', name: 'offer.description', visible: false},
                    {data: 'content', name: 'offer.content', visible: false},
                    {data: 'created_at', name: 'offer.created_at'},
                    {data: 'updated_at', name: 'offer.updated_at'},
                    {data: 'action', name: 'actions', searchable: false, orderable: false, width: "65px"}
                ]
            });

            var colvis = new $.fn.dataTable.ColVis(table, {
                buttonText: 'Select Columns'
            });

            $(colvis.button()).insertBefore('#offers-table_filter').addClass('col-sm-3');
        });
    </script>
@stop