@extends('layout.admin')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col 12">
            <div class="card">
                <h5 class="card-header">Add Product</h5>
                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="Category" class="col-form-label">Category</label>
                                <select name="category_id" id="category" class="form-control select-cat">
                                    <option value="">-- Select Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="subcategory" class="col-form-label">Sub Category</label>
                                <select name="subcategory_id" id="" class="form-control select-subcat">
                                    <option value="">-- Select SubCategory --</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="size" class="col-form-label">Size</label>
                            <select name="size_id" id="" class="form-control select-cat">
                                <option value="">-- Select Size --</option>
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->size }}</option>
                                @endforeach
                            </select>
                        </div>
                         <div class="form-group col-md-12">
                            <label for="color" class="col-form-label">Color</label>
                            <select name="color_id" id="" class="form-control select-cat">
                                <option value="">-- Select Color --</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->color }}</option>
                                @endforeach
                            </select>
                        </div>
                         <div class="form-group col-md-12">
                            <label for="stuff" class="col-form-label">Stuff</label>
                            <select name="stuff_id" id="" class="form-control select-cat">
                                <option value="">-- Select Stuff --</option>
                                @foreach ($stuffs as $stuff)
                                    <option value="{{ $stuff->id }}">{{ $stuff->stuff }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                       

                        <div class="form-group">
                            <label for="name" class="col-form-label">Name</label>
                            <input id="name" type="text" class="form-control" name="name">
                        </div>
                            <div class="form-group">
                                <label for="name" class="col-form-label">Stock</label>
                                <input id="name" type="text" class="form-control" name="stock">
                            </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input id="price" type="number" placeholder="Enter Price" class="form-control"
                                name="price">
                        </div>
                        <div class="form-group">
                            <label for="file" class="col-form-label">Image</label>
                            <input id="file" type="file" class="form-control" name="image">
                        </div>
                           <div class="form-group">
                            <label for="file" class="col-form-label">Images</label>
                            <input id="file" type="file" class="form-control" name="images[]" multiple>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary px-5">Save Product</button>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // ajax call
        //jquery

        $(document).ready(function() {
            $('body').on('change', '#category', function(e) {
                e.preventDefault();
                let cat_id = $(this).val();

                $.ajax({
                    url: "{{ url('admin/category/subcategory') }}/" + cat_id,
                    type: 'GET',
                    success: function(response) {
                        console.log(response.subcategories);
                        $('.select-subcat').empty();
                        response.subcategories.forEach(function(subcategory) {
                            $('.select-subcat').append(
                                '<option value="' + subcategory
                                .id + '">' + subcategory.name + '</option>'
                            );
                        });
                    },
                    error: function(error) {
                        console.
                        log(error);
                    }

                });
            });
        });
    </script>
@endsection