@extends('layout.admin')
@section('content')
    <div class="row">
        <!-- ============================================================== -->
        <!-- basic table  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Product Table</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>SubCategory</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>Stuff</th>
                                    <th>Stock</th>
                                    <th>Description</th>

                                    <th>Actions</th>
<th>Action</th>
<th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->subcategory->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            @if ($product->image)
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->image }}"
                                                    width="50" height="50">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>

                                        <td>{{ $product->size->size }}</td>
                                        <td>{{ $product->color->color }}</td>
                                        <td>{{ $product->stuff->stuff }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td><a href="{{ url('admin/product/edit', $product->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a></td>
                                        <td><a href="{{ url('admin/product/destroy', $product->id) }}"
                                                onclick="return confirm('Are you sure you want to delete this product?')"
                                                class="btn btn-danger btn-sm">Delete</a></td>
                                        <td><a href="{{ url('admin/product/detail', $product->id) }}"
                                                class="btn btn-primary btn-sm">Details</a></td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end basic table  -->
        <!-- ============================================================== -->
    </div>
@endsection
