@extends('layout.admin')

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Reviews</h5>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product</th>
                                    <th>Subcategory</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Review</th>
                                    <th>Action</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td>{{ $review->product_id }}</td>
                                        <td>{{ $review->product->name }}</td>
                                        <td>{{$review->product->subcategory->name}}</td>

                                        <td>{{ $review->name }}</td>
                                        <td>{{ $review->email }}</td>
                                        <td>{{ $review->review }}</td>

                                        <td>
                                            <a href="{{ route('review.destroy', $review->id) }}"
                                                onclick="return confirm('Are you sure you want to delete this review?')"
                                                class="btn btn-danger btn-sm">
                                                Delete
                                            </a>
                                        </td>
                                                          <td>
                <a href="{{ route('review.show', $review->id) }}"
                   class="btn btn-info btn-sm">View</a>
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
@endsection
