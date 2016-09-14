@extends('admin.layouts.master')

@section('title', 'Index - Users - Villato')
@section('page-header', 'Users Index')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="companies-table" class="table table-condensed" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <!-- <th>Primary Region</th> -->
                                <th>Slug</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Mobile</th>
                                <th>Street</th>
                                <th>Postal Code</th>
                                <th>Website</th>
                                <th>Facebook</th>
                                <th>Newsletter</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ route('admin.company.create') }}" class="btn btn-success pull-right">New User</a>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div>
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function() {
            var table = $('#companies-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.company.data') }}',
                columns: [
                    {data: 'id', name: 'company.id'},
                    {data: 'name', name: 'company.name'},
                    // {data: 'regionname', name: 'region.name'},
                    {data: 'slug', name: 'company.slug'},
                    {data: 'email', name: 'company.email', visible: false},
                    {data: 'phone', name: 'company.phone', visible: false},
                    {data: 'mobile', name: 'company.mobile', visible: false},
                    {data: 'street', name: 'company.street', visible: false},
                    {data: 'postal_code', name: 'company.postal_code', visible: false},
                    {data: 'website', name: 'company.website', visible: false},
                    {data: 'facebook', name: 'company.facebook', visible: false},
                    {data: 'newsletter', name: 'company.newsletter', visible: false},
                    {data: 'created_at', name: 'company.created_at'},
                    {data: 'updated_at', name: 'company.updated_at'},
                    {data: 'action', name: 'actions', searchable: false, orderable: false, width: "65px"}
                ]
            });

            var colvis = new $.fn.dataTable.ColVis(table, {
                buttonText: 'Select Columns'
            });

            $(colvis.button()).insertBefore('#companies-table_filter').addClass('col-sm-3');
        });
    </script>
@stop