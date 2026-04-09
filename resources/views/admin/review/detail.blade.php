@extends('layout.admin')
@section('content')
    <div class="card">
    <div class="card-header">
        <h5>Review Message Detail</h5>
    </div>
    <div class="card-body">
      <p><strong>Product ID:</strong> {{ $reviews->product_id }}</p>
      <p><strong>Product name:</strong>{{$reviews->product->name}}</p>
      <p><strong>Subcategory Name:</strong>{{$reviews->product->subcategory->name}}</p>
<p><strong>Name:</strong> {{ $reviews->name }}</p>
<p><strong>Email:</strong> {{ $reviews->email }}</p>

<p><strong>Review:</strong></p>
<div class="alert alert-secondary">
    {{ $reviews->review }}
    </div>
    <div class="card-footer">
        <a href="{{ route('review.index') }}" class="btn btn-primary">Back</a>
    </div>
</div>
@endsection