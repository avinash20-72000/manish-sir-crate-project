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
                                <li class="breadcrumb-item active" aria-current="page"><span>Crate Receive Form</span></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Crate Receive Form</h4>

                {!! Form::open( [
                    'url' => route('crateReceive'),
                    'method' => 'POST',
                    'onSubmit' => "document.getElementById('submit').disabled=true;",
                    'class' => 'forms-sample',
                ]) !!}
                <div class="row">
                    <div class="form-group col-md-6">
                        {!! Form::label('barcode', 'Scan Crates (Barcodes):') !!}<span style="color: red;"> *</span>
                        {!! Form::text('barcode',null, ['class' => 'form-control', 'placeholder' => 'Scan Crate Barcode', 'required']) !!}
                    </div>
                </div>

                <button type="submit" id="submit" class="btn btn-primary me-2">Submit</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('footerScripts')
    <script>

    </script>
@endsection
