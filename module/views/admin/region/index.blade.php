@extends('admin.layouts.master')

@section('title', 'Index - Region - Villato')
@section('page-header', 'Region Index')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="regions-table" class="table table-condensed order-column">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Population</th>
                                <th>Active</th>
                                <!--  <th>Priceflag</th>
                                <th>Price</th> -->
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ route('admin.region.create') }}" class="btn btn-success pull-right">New Region</a>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div>
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function() {
            var table = $('#regions-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.region.data') }}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'slug', name: 'slug'},
                    {data: 'population', name: 'population'},
                    {data: 'active', name: 'active'},
                    // {data: 'priceflag', name: 'priceflag',"mRender": function (data, type, full) {
                    //         if(full['priceflag'] == 'Paid')
                    //         {   
                    //                 return full['priceflag']+' -€'+ full['catprice'] ;
                    //         }
                    //         else 
                    //         {
                    //             return full['priceflag'];                          
                    //         }
                    // }},
                    // {data: 'catprice', name: 'catprice', visible: false},
                    {data: 'created_at', name: 'created_at', width: "130px"},
                    {data: 'updated_at', name: 'updated_at', width: "130px"},
                    {data: 'action', name: 'actions', searchable: false, orderable: false, width: "65px"}
                ]
            });

            var colvis = new $.fn.dataTable.ColVis(table, {
                buttonText: 'Select Columns'
            });

            $(colvis.button()).insertBefore('#regions-table_filter').addClass('col-sm-3');
        });
    </script>
@stop