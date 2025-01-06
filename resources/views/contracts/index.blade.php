@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <div class="d-flex justify-content-between align-items-center mb-3"> -->
        <h1>Contracts</h1>
        <a href="{{ route('contracts.create') }}" class="btn btn-primary">Create Contract</a>
        <a href="{{ route('contracts.export') }}" class="btn btn-success">Export to CSV</a>
    <!-- </div> -->

    @if($contracts->isEmpty())
        <p>No contracts found.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Currency</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contracts as $contract)
                    <tr>
                        <td>{{ $contract->id }}</td>
                        <td>{{ $contract->description }}</td>
                        <td>{{ $contract->amount }}</td>
                        <td>{{ $contract->currency }}</td>
                        <td>{{ $contract->category }}</td>
                        <td>{{ $contract->status }}</td>
                        <td>{{ $contract->creator->name ?? 'N/A' }}</td>
                        <td>{{ $contract->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('contracts.edit', $contract->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        {{ $contracts->links() }}
    @endif
</div>
@endsection
