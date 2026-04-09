@extends('layout.admin')
@section('content')
<div class="row">
    @foreach ($product->images as $key => $image)

    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                Image
            </div>
            <div class="card-body">

               <img src="{{ asset($image->image)  }}" alt="" width="100%">
            </div>
            <a href="{{ route('product.imagedelete', $image->id) }}" class="btn btn-danger">Delete</a>

        </div>
    </div>
    @endforeach

</div>
@endsection
