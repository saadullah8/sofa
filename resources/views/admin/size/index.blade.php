@extends('layout.admin')
@section('content')
    <div class="row">
        <!-- ============================================================== -->
        <!-- basic table  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Size Table</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>Size</th>
                                    <th>Action</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($values as $value)
                                    <tr>
                                        <td>{{ $value->size }}</td>

                                        <td><a href="{{ route('size.edit', $value->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a></td>
                                        <td><a href="{{ route('size.destroy', $value->id) }}"
                                                onclick="return confirm('Are you sure you want to delete this size?')"
                                                class="btn btn-danger btn-sm">Delete</a></td>
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