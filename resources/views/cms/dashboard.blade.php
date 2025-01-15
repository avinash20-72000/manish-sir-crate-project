@extends('cms.layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-4 mb-4 stretch-card transparent">
            <div class="card card-inverse-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <p class="mb-4">Total Crates</p>
                            <p class="fs-30 mb-2">{{ $crateStats->total }}</p>
                        </div>
                        <div class="col-6 d-flex flex-column h1 mt-2 align-items-center">
                            <i class="fa fa-cubes icon-md"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4 stretch-card transparent">
            <div class="card card-inverse-success">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <p class="mb-4">Available Crates</p>
                            <p class="fs-30 mb-2">{{ $crateStats->available }}</p>
                        </div>
                        <div class="col-6 d-flex flex-column h1 mt-2 align-items-center">
                            <i class="fa fa-cubes icon-md"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4 stretch-card transparent">
            <div class="card card-inverse-warning">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <p class="mb-4">Assigned Crates</p>
                            <p class="fs-30 mb-2">{{ $crateStats->assigned }}</p>
                        </div>
                        <div class="col-6 d-flex flex-column h1 mt-2 align-items-center">
                            <i class="fa fa-cubes icon-md"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card card-outline-success">
                <div class="card-body">
                    <p class="card-title mb-0">Companies With Crates</p>
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Company</th>
                                    <th>Crates</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($companies as $company)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $company->name }}</td>
                                        <td><span class="badge badge-outline-primary">{{ $company->crate_transfers_count }}</span></td>
                                    </tr>
                                @empty
                                    <td colspan="2" class="text-center">No data available in table</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
