@extends('layouts.app')

@section('subtitle', 'Edit Call')
@section('content_header_title', 'Calls')
@section('content_header_subtitle', 'Edit Call')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Call Details</h3>
                </div>
                <form action="{{ route('calls.update', $call) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="call_id">Call ID</label>
                            <input type="text" class="form-control @error('call_id') is-invalid @enderror" id="call_id" name="call_id" value="{{ old('call_id', $call->call_id) }}">
                            @error('call_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type', $call->type) }}">
                            @error('type')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $call->date ? $call->date->format('Y-m-d') : '') }}">
                            @error('date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="party_id">Party</label>
                            <select class="form-control @error('party_id') is-invalid @enderror" id="party_id" name="party_id">
                                <option value="">Select Party</option>
                                @foreach ($parties as $party)
                                    <option value="{{ $party->id }}" {{ old('party_id', $call->party_id) == $party->id ? 'selected' : '' }}>{{ $party->name }}</option>
                                @endforeach
                            </select>
                            @error('party_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="user_id">User (Call Taken By)</label>
                            <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                                <option value="">Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $call->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="reported_problem">Reported Problem</label>
                            <textarea class="form-control @error('reported_problem') is-invalid @enderror" id="reported_problem" name="reported_problem" rows="3">{{ old('reported_problem', $call->reported_problem) }}</textarea>
                            @error('reported_problem')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="action_taken">Action Taken</label>
                            <textarea class="form-control @error('action_taken') is-invalid @enderror" id="action_taken" name="action_taken" rows="3">{{ old('action_taken', $call->action_taken) }}</textarea>
                            @error('action_taken')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" class="form-control @error('status') is-invalid @enderror" id="status" name="status" value="{{ old('status', $call->status) }}">
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="next_follow_up_date">Next Follow Up Date</label>
                            <input type="date" class="form-control @error('next_follow_up_date') is-invalid @enderror" id="next_follow_up_date" name="next_follow_up_date" value="{{ old('next_follow_up_date', $call->next_follow_up_date ? $call->next_follow_up_date->format('Y-m-d') : '') }}">
                            @error('next_follow_up_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="priority">Priority</label>
                            <input type="text" class="form-control @error('priority') is-invalid @enderror" id="priority" name="priority" value="{{ old('priority', $call->priority) }}">
                            @error('priority')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">Update Call</button>
                        <a href="{{ route('calls.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@push('css')
@endpush

@push('js')
@endpush
