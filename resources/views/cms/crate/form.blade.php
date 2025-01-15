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
                                <li class="breadcrumb-item"><a href="{{ route('crate.index') }}">Crate List</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Crate Form</span></li>
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
                <div class="row">
                    <div class="col-10">
                        <h4 class="card-title">Crate Form</h4>
                    </div>
                    @if(!empty($object->status))
                        <div class="col-2 text-right">
                            <label class="badge badge-success"> {{ ucfirst($object->status) }}</label>
                        </div>
                    @endif
                </div>

                {!! Form::model($object, [
                    'url' => $url,
                    'method' => $method,
                    'onSubmit' => "document.getElementById('submit').disabled=true;",
                    'class' => 'forms-sample',
                ]) !!}
                <input type="hidden" name="id" value="{{ $object->id }}">
                <div class="row">
                    <div class="form-group col-md-6">
                        {!! Form::label('barcode', 'Barcode') !!}<span style="color: red;"> *</span>
                        {!! Form::text('barcode', null, ['class' => 'form-control barcode', 'placeholder' => 'Enter Barcode', 'required']) !!}
                    </div>
                    <div class="form-group col-md-6">
                        {!! Form::label('size', 'Size') !!}<span style="color: red;"> *</span>
                        {!! Form::text('size', null, ['class' => 'form-control size', 'placeholder' => 'Enter Size', 'required']) !!}
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
