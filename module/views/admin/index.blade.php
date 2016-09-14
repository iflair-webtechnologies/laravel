@extends('admin.layouts.master')

@section('title', 'Admin - Villato')
@section('page-header','Dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $companyCount }}</h3>
                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $regionCount }}</h3>
                    <p>Regions</p>
                </div>
                <div class="icon">
                    <i class="ion ion-earth"></i>
                </div>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $categoryCount }}</h3>
                    <p>Categories</p>
                </div>
                <div class="icon">
                    <i class="ion ion-folder"></i>
                </div>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $productCount }}</h3>
                    <p>Products / Services</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pricetags"></i>
                </div>
            </div>
        </div><!-- ./col -->
    </div>
@stop