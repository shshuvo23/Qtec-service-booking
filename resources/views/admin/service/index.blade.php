@extends('admin.layouts.master')

@section('service', 'active')
@section('title') {{ $data['title'] ?? '' }} @endsection

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        #dataTables {
            min-height: 200px;
        }
        .date-edit{
            padding: 0 !important;
            min-width: 0 !important;
        }
    </style>
@endpush
@section('content')
    <div class="content-wrapper">

        <div class="content pt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-md-flex justify-content-between align-items-center">
                                    <div class="mb-2 mb-md-0">
                                        <h3 style="font-size:1.5rem;">Manage {{ $data['title'] ?? '' }} </h3>
                                    </div>

                                </div>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table id="dataTables" class="table table-hover text-nowrap jsgrid-table">
                                    <thead>
                                        <tr>
                                            <th width="30%">Name</th>
                                            <th width="20%">Description</th>
                                            <th width="20%">Price</th>
                                            <th width="20%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data['services'] as $key => $row)
                                            <tr>
                                                <td>
                                                    <p class="mb-0">{{ $row->name}}</p>
                                                </td>
                                                <td>{{ $row->description }}</td>
                                                <td>{{ $row->price }}</td>
                                                <td>{{ $row->status == 1 ? 'Active' : 'Inactive' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="9">No Records Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('script')

@endpush
