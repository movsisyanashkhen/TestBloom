@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Contract</h1>
    <form action="{{ route('contracts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" name="description" id="description" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="currency" class="form-label">Currency</label>
            <input type="text" name="currency" id="currency" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" name="category" id="category" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="Active">Active</option>
                <option value="Completed">Completed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
