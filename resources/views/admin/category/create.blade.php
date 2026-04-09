@extends('layout.admin')
@section('content')
    <!-- basic form  -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="section-block" id="basicform">
                <h3 class="section-title"> Form </h3>
                <p>Enter Category Details</p>
            </div>
            <div class="card">
                <h5 class="card-header">Category Form</h5>
                <div class="card-body">
                    <form action="{{ route('category.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name</label>
                            <input id="name" name="name"  type="text" class="form-control">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-5">Save Category</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end basic form  -->
@endsection