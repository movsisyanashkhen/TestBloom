@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Contract Details</h1>
    <p><strong>Description:</strong> {{ $contract->description }}</p>
    <p><strong>Amount:</strong> {{ $contract->amount }}</p>
    <p><strong>Currency:</strong> {{ $contract->currency }}</p>
    <p><strong>Category:</strong> {{ $contract->category }}</p>
    <p><strong>Status:</strong> {{ $contract->status }}</p>
    <p><strong>Created By:</strong> {{ $contract->created_by }}</p>
    <p><strong>Created At:</strong> {{ $contract->created_at }}</p>
    <a href="{{ route('contracts.index') }}" class="btn btn-primary">Back to List</a>
</div>
@endsection
