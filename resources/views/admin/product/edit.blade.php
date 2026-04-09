@extends('layout.admin')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col 12">
            <div class="card">
                <h5 class="card-header">Add Product</h5>
                <div class="card-body">
                    <form action="{{ route('product.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="Category" class="col-form-label">Category</label>
                                <select name="category_id" id="category_select" class="form-control select-cat">
                                    <option value="">-- Select Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if ($category->id == $product->category_id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="subcategory" class="col-form-label">Sub Category</label>
                                <select name="subcategory_id" id="subcat_select" class="form-control select-subcat">
                                    <option value="">-- Select SubCategory --</option>
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}"
                                            @if ($subcategory->id == $product->subcategory_id) selected @endif>{{ $subcategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="size" class="col-form-label">Size</label>
                            <select name="size_id" id="" class="form-control ">
                                <option value="">-- Select Size --</option>
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}" @if ($size->id == $product->size_id) selected @endif>
                                        {{ $size->size }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="color" class="col-form-label">Color</label>
                            <select name="color_id" id="" class="form-control ">
                                <option value="">-- Select Color --</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}" @if ($color->id == $product->color_id) selected @endif>
                                        {{ $color->color }}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="stuff" class="col-form-label">Stuff</label>
                    <select name="stuff_id" id="" class="form-control ">
                        <option value="">-- Select stuff --</option>
                        @foreach ($stuffs as $stuff)
                            <option value="{{ $stuff->id }}" @if ($stuff->id == $product->stuff_id) selected @endif>
                                {{ $stuff->stuff }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="name" class="col-form-label">Name</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{ $product->name }}">
                </div>
                <div class="form-group">
                    <label for="name" class="col-form-label">Stock</label>
                    <input id="name" type="text" class="form-control" name="stock" value="{{ $product->stock }}">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input id="price" type="number" placeholder="Enter Price" class="form-control" name="price"
                        value="{{ $product->price }}">
                </div>
                <div class="form-group">
                    <label for="file" class="col-form-label">Image</label>
                    <input id="file" type="file" class="form-control" name="image">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{ $product->description }}</textarea>

                </div>
                <button type="submit" class="btn btn-primary px-5">Update Product</button>


                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('body').on('change', '#category_select', function(e) {
                e.preventDefault();
                let cat_id = $(this).val();

                $.ajax({
                    url: "{{ url('admin/category/subcategory') }}/" + cat_id,
                    type: 'GET',
                    success: function(response) {
                        console.log(response.subcategories);
                        $('#subcat_select').empty();
                        response.subcategories.forEach(function(subcategory) {
                            $('#subcat_select').append(
                                '<option value="' + subcategory.id + '">' +
                                subcategory.name + '</option>'
                            );
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }

                });
            });
        });
    </script>
@endsection
