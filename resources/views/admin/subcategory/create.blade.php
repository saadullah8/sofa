@extends('layout.admin')
@section('content')
    <!-- basic form  -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="section-block" id="basicform">
                <h3 class="section-title"> Form </h3>
                <p>Enter SubCategory Details</p>
            </div>
            <div class="card">
                <h5 class="card-header">SubCategory Form</h5>
                <div class="card-body">
                    <form action="{{ route('subcategory.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">Select Category</label>
                            <select name="category_id" id="" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach

                            </select>

                        </div>

                        <div class="form-group">
                         <label for="name" class="col-form-label">Name</label>
                         <input type="text" id="name" class="form-control" name="name">

                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-5">Save SubCategory</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end basic form  -->
@endsection