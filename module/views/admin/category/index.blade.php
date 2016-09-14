@extends('admin.layouts.master')

@section('title', 'Index - Category - Villato')
@section('page-header', 'Category Index')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="categories-table" class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <!-- <th>Priceflag</th>
                                <th>Price</th> -->
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ route('admin.category.create') }}" class="btn btn-success pull-right">New Category</a>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div>
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function() {
            var table = $('#categories-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.category.data') }}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'slug', name: 'slug'},
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
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'actions', searchable: false, orderable: false, width: "65px"}
                ]
            });

            var colvis = new $.fn.dataTable.ColVis(table, {
                buttonText: 'Select Columns'
            });

            $(colvis.button()).insertBefore('#categories-table_filter').addClass('col-sm-3');
        });
    </script>
@stop