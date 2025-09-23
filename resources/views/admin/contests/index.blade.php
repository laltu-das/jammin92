@extends('layouts.app')

@section('title', 'Contest Management - Jammin\'')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="display-4">🏆 Contest Management</h1>
                <div>
                    <a href="/admin" class="btn btn-outline-secondary me-2">← Back to Admin</a>
                    <a href="{{ route('admin.contests.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> New Contest
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h3 class="mb-0">All Contests</h3>
                </div>
                <div class="card-body">
                    @if($contests->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th>Images</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contests as $contest)
                                        <tr>
                                            <td>{{ $contest->title }}</td>
                                            <td>{{ $contest->start_date->format('M d, Y') }} - {{ $contest->end_date->format('M d, Y') }}</td>
                                            <td>
                                                @if($contest->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>{{ $contest->images->count() }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('admin.contests.show', $contest) }}" class="btn btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.contests.edit', $contest) }}" class="btn btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('admin.contests.upload', $contest) }}" class="btn btn-primary">
                                                        <i class="fas fa-upload"></i>
                                                    </a>
                                                    <form action="{{ route('admin.contests.destroy', $contest) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this contest?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-trophy fa-3x text-muted mb-3"></i>
                            <p class="lead">No contests found</p>
                            <a href="{{ route('admin.contests.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Create your first contest
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection