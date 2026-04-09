@extends('layout.admin')
@section('content')
    <div class="row">
        <!-- ============================================================== -->
        <!-- basic table  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Color Table</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>Color</th>
                                    <th>Action</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($colors as $color)
                                    <tr>
                                        <td>{{ $color->color }}</td>

                                        <td><a href="{{ route('color.edit', $color->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a></td>
                                        <td><a href="{{ route('color.destroy', $color->id) }}"
                                                onclick="return confirm('Are you sure you want to delete this color?')"
                                                class="btn btn-success btn-sm">Delete</a></td>
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
