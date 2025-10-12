@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Parties')
@section('content_header_title', 'Parties')
@section('content_header_subtitle', 'Manage Parties')

{{-- Content body: main page content --}}

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Parties List</h3>
                    <div class="card-tools">
                        <a href="{{ route('parties.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add Party
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="parties-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parties as $party)
                            <tr>
                                <td>{{ $party->id }}</td>
                                <td>{{ $party->name }}</td>
                                <td>{{ $party->email }}</td>
                                <td>{{ $party->mobile }}</td>
                                <td>
                                    <a href="{{ route('parties.show', $party) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('parties.edit', $party) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('parties.destroy', $party) }}" method="POST" style="display:inline;">
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
        $('#parties-table').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#parties-table_wrapper .col-md-6:eq(0)');
    });
</script>
@endpush
