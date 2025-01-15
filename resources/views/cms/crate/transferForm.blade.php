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
                                <li class="breadcrumb-item active" aria-current="page"><span>Crate Transfer Form</span></li>
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
                <h4 class="card-title">Crate Transfer form</h4>

                {!! Form::open( [
                    'url' => route('crateTransferStore'),
                    'method' => 'POST',
                    'onSubmit' => "document.getElementById('submit').disabled=true;",
                    'class' => 'forms-sample',
                ]) !!}
                <div class="row">
                    <div class="form-group col-md-3">
                        {!! Form::label('company_id', 'Select Company') !!}<span style="color: red;"> *</span>
                        {!! Form::select('company_id', $companies, null, [
                            'class' => 'form-control  select2',
                            'data-placeholder' => 'Select Company',
                            'placeholder' => 'Select Company',
                            'required',
                        ]) !!}
                    </div>
                    <div class="form-group col-md-9">
                        {!! Form::label('crate_ids[]', 'Select Crates (Barcodes):') !!}<span style="color: red;"> *</span>
                        {!! Form::select('crate_ids[]', $crates,null, ['class' => 'form-control select2', 'id' => 'crate_ids','multiple' => true,'data-placeholder' => 'Select Crate', 'required']) !!}
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
