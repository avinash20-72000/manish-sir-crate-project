@extends('cms.layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-xl-12 text-right">
                    <div class="justify-content-end d-flex">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-custom">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Crate List</span></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-10">
                        <h4 class="card-title">Crate List</h4>
                    </div>
                    <div class="col-2 text-right">
                        <a href="{{ route('crate.create') }}"><label class="badge badge-outline-primary"><i class="mdi mdi-account-plus"></i> Add</label></a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example1" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Barcode</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footerScripts')
    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                ajax: "{{ route('crate.index') }}",
                order: [],
                sorting: true,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'Index',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'barcode',
                        name: 'barcode',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endsection
