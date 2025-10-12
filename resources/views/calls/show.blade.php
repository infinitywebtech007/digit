@extends('layouts.app')

@section('subtitle', 'Call Details')
@section('content_header_title', 'Calls')
@section('content_header_subtitle', 'View Call')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Call #{{ $call->id }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('calls.edit', $call) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('calls.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-list"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">ID</dt>
                        <dd class="col-sm-9">{{ $call->id }}</dd>
                        <dt class="col-sm-3">Call ID</dt>
                        <dd class="col-sm-9">{{ $call->call_id ?: 'N/A' }}</dd>
                        <dt class="col-sm-3">Type</dt>
                        <dd class="col-sm-9">{{ $call->type ?: 'N/A' }}</dd>
                        <dt class="col-sm-3">Date</dt>
                        <dd class="col-sm-9">{{ $call->date ? $call->date->format('d/m/Y') : 'N/A' }}</dd>
                        <dt class="col-sm-3">Party</dt>
                        <dd class="col-sm-9">{{ $call->party ? $call->party->name : 'N/A' }}</dd>
                        <dt class="col-sm-3">User (Call Taken By)</dt>
                        <dd class="col-sm-9">{{ $call->user ? $call->user->name : 'N/A' }}</dd>
                        <dt class="col-sm-3">Reported Problem</dt>
                        <dd class="col-sm-9">{{ $call->reported_problem ?: 'N/A' }}</dd>
                        <dt class="col-sm-3">Action Taken</dt>
                        <dd class="col-sm-9">{{ $call->action_taken ?: 'N/A' }}</dd>
                        <dt class="col-sm-3">Status</dt>
                        <dd class="col-sm-9">{{ $call->status ?: 'N/A' }}</dd>
                        <dt class="col-sm-3">Next Follow Up Date</dt>
                        <dd class="col-sm-9">{{ $call->next_follow_up_date ? $call->next_follow_up_date->format('d/m/Y') : 'N/A' }}</dd>
                        <dt class="col-sm-3">Priority</dt>
                        <dd class="col-sm-9">{{ $call->priority ?: 'N/A' }}</dd>
                        <dt class="col-sm-3">Created At</dt>
                        <dd class="col-sm-9">{{ $call->created_at->format('d/m/Y H:i') }}</dd>
                        <dt class="col-sm-3">Updated At</dt>
                        <dd class="col-sm-9">{{ $call->updated_at->format('d/m/Y H:i') }}</dd>
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
