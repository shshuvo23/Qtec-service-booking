@extends('admin.layouts.master')
@section('dashboard', 'active')
@section('title') {{ $data['title'] ?? '' }} @endsection
@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <style>
        .circle_div {
            border-radius: 100%;
            height: 20px;
            width: 20px;
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
        }

        .heatmap-container {
            position: relative;
            width: 300px;
            height: 300px;
            margin: 0 auto;
        }

        .heatmap-axis-y {
            position: absolute;
            top: 50%;
            left: -40px;
            transform: rotate(-90deg);
            font-weight: bold;
        }

        .heatmap-axis-x {
            position: absolute;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            font-weight: bold;
        }

        .heatmap-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            grid-template-rows: repeat(5, 1fr);
            gap: 1px;
            width: 100%;
            height: 100%;
        }

        .heatmap-cell {
            border: 0px solid #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            background-color: #f9f9f9;
        }

        /* Prevent table from scrolling when dropdown is open */
        .table-responsive.table-fixed {
            min-height: 340px;
        }

        .opacity-50 {
            opacity: 0.5 !important;
        }

        .card-btn {
            font-size: 14px;
            background-color: #0000006b;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }
        .date-edit{
            padding: 0 !important;
            min-width: 0 !important;
        }

        /* .summary-card:hover {
            transform: translateY(-2px);
        } */
    </style>
@endpush
@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0">Welcome, {{ auth()->user()->name }}</h4>
                        <div class="">Last Login At :
                            {{ !empty(auth()->user()->last_login_at) ? date('d-m-y H:i', strtotime(auth()->user()->last_login_at)) : '' }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">


            </div>
        </div>
    </div>

@endsection
@push('script')
    
@endpush
