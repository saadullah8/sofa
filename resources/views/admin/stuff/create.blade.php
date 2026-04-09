@extends('layout.admin')
@section('content')
    <!-- basic form  -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="section-block" id="basicform">
                <h3 class="section-title"> Form </h3>
                <p>Enter Stuff Details</p>
            </div>
            <div class="card">
                <h5 class="card-header">Stuff Form</h5>
                <div class="card-body">
                    <form action="{{ route('stuff.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="stuff" class="col-form-label">Stuff</label>
                            <input id="stuff" name="stuff"  type="text" class="form-control" placeholder="Enter Stuff">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-5">Save Stuff</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end basic form  -->
@endsection