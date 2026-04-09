@extends('layout.admin')
@section('content')
    <!-- basic form  -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="section-block" id="basicform">
                <h3 class="section-title"> Form </h3>
                <p>Edit Size Details</p>
            </div>
            <div class="card">
                <h5 class="card-header">Size Form</h5>
                <div class="card-body">
                    <form action="{{ route('size.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="id" id="" value="{{$size->id}}">
                            <label for="size" class="col-form-label">Size</label>
                            <input id="size" name="size"  type="text" class="form-control" value="{{$size->size}}">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-5">Update Size</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end basic form  -->
@endsection