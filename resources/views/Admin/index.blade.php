@extends('layouts.dashboard.app')
@section('title')
    Home
@endsection
@section('body')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!-- Content Row -->
        @livewire('admin.statics')
        <!-- Content Row -->
        <!-- chart row -->
        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-body">

                        <h1>{{ $postsChart->options['chart_title'] }}</h1>
                        {!! $postsChart->renderHtml() !!}

                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-body">

                        <h1>{{ $usersChart->options['chart_title'] }}</h1>
                        {!! $usersChart->renderHtml() !!}

                    </div>
                </div>
            </div>
        </div>
        <!-- chart row -->

        <!-- Posts And Comments Row -->
        @livewire('admin.latest-posts-adn-comments')

    </div>
@endsection
@push('js')
    {!! $postsChart->renderChartJsLibrary() !!}
    {!! $postsChart->renderJs() !!}
    {!! $usersChart->renderJs() !!}
@endpush
