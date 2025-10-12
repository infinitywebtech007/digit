@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Calls')
@section('content_header_title', 'Calls')
@section('content_header_subtitle', 'Manage Calls')

{{-- Content body: main page content --}}

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Calls List</h3>
                    <div class="card-tools">
                        <a href="{{ route('calls.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add Call
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="calls-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Call ID</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Party</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Priority</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($calls as $call)
                            <tr>
                                <td>{{ $call->id }}</td>
                                <td>{{ $call->call_id ?: 'N/A' }}</td>
                                <td>{{ $call->type ?: 'N/A' }}</td>
                                <td>{{ $call->date ? $call->date->format('d/m/Y') : 'N/A' }}</td>
                                <td>{{ $call->party ? $call->party->name : 'N/A' }}</td>
                                <td>{{ $call->user ? $call->user->name : 'N/A' }}</td>
                                <td>{{ $call->status ?: 'N/A' }}</td>
                                <td>{{ $call->priority ?: 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('calls.show', $call) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('calls.edit', $call) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('calls.destroy', $call) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
<script>
    $(document).ready(function() {
        $('#calls-table').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#calls-table_wrapper .col-md-6:eq(0)');
    });
</script>
@endpush
