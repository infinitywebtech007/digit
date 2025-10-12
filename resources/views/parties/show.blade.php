@extends('layouts.app')

@section('subtitle', 'Party Details')
@section('content_header_title', 'Parties')
@section('content_header_subtitle', 'View Party')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">{{ $party->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('parties.edit', $party) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('parties.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-list"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">ID</dt>
                        <dd class="col-sm-9">{{ $party->id }}</dd>
                        <dt class="col-sm-3">Name</dt>
                        <dd class="col-sm-9">{{ $party->name }}</dd>
                        <dt class="col-sm-3">Email</dt>
                        <dd class="col-sm-9">{{ $party->email ?: 'N/A' }}</dd>
                        <dt class="col-sm-3">Mobile</dt>
                        <dd class="col-sm-9">{{ $party->mobile ?: 'N/A' }}</dd>
                        <dt class="col-sm-3">Address</dt>
                        <dd class="col-sm-9">{{ $party->address ?: 'N/A' }}</dd>
                        <dt class="col-sm-3">Pin Code</dt>
                        <dd class="col-sm-9">{{ $party->pin_code ?: 'N/A' }}</dd>
                        <dt class="col-sm-3">Notes</dt>
                        <dd class="col-sm-9">{{ $party->notes ?: 'N/A' }}</dd>
                        <dt class="col-sm-3">Created At</dt>
                        <dd class="col-sm-9">{{ $party->created_at->format('d/m/Y H:i') }}</dd>
                        <dt class="col-sm-3">Updated At</dt>
                        <dd class="col-sm-9">{{ $party->updated_at->format('d/m/Y H:i') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('css')
@endpush

@push('js')
@endpush
