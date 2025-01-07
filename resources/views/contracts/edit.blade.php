@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Contract</h1>
    <form action="{{ route('contracts.update', $contract) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" name="description" id="description" class="form-control" value="{{ $contract->description }}" required>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" value="{{ $contract->amount }}" required>
        </div>
        <div class="mb-3">
            <label for="currency" class="form-label">Currency</label>
            <select name="currency" id="currency" class="form-select">
                <option value="AMD" {{ $contract->currency == 'AMD' ? 'selected' : '' }}>AMD</option>
                <option value="USD" {{ $contract->currency == 'USD' ? 'selected' : '' }}>USD</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" name="category" id="category" class="form-control" value="{{ $contract->category }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="Active" {{ $contract->status == 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Completed" {{ $contract->status == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
