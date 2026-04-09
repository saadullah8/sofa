@extends('layout.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Contact Message Detail</h5>
    </div>
    <div class="card-body">
        <p><strong>Name:</strong> {{ $contacts->name }}</p>
        <p><strong>Email:</strong> {{ $contacts->email }}</p>
        <p><strong>Subject:</strong> {{ $contacts->subject }}</p>
        <p><strong>Message:</strong></p>
        <div class="alert alert-secondary">
            {{ $contacts->message }}
        </div>
    </div>
    <div class="card-footer">
        <a href="{{ route('contact.index') }}" class="btn btn-primary">Back</a>
    </div>
</div>
@endsection