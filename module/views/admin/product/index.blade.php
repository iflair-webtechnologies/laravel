@extends('admin.layouts.master')

@section('title', 'Index - Product - Villato')
@section('page-header', 'Product Index')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="products-table" class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <!-- <th>Category</th> -->
                                <th>Slug</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ route('admin.product.create') }}" class="btn btn-success pull-right">New Product</a>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div>
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function() {
            var table = $('#products-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.product.data') }}',
                columns: [
                    {data: 'id', name: 'product.id'},
                    {data: 'name', name: 'product.name'},
                    //{data: 'categoryname', name: 'category.name'},
                    {data: 'slug', name: 'product.slug'},                   
                    {data: 'created_at', name: 'product.created_at'},
                    {data: 'updated_at', name: 'product.updated_at'},
                    {data: 'action', name: 'actions', searchable: false, orderable: false, width: "65px"}
                ]
            });

            var colvis = new $.fn.dataTable.ColVis(table, {
                buttonText: 'Select Columns',
            });

            $(colvis.button()).insertBefore('#products-table_filter').addClass('col-sm-3');
        });
    </script>
@stop