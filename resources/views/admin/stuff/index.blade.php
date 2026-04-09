@extends('layout.admin')
@section('content')
    <div class="row">
        <!-- ============================================================== -->
        <!-- basic table  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">stuff Table</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>Stuff</th>
                                    <th>Action</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stuffs as $stuff)
                                    <tr>
                                        <td>{{ $stuff->stuff }}</td>

                                        <td><a href="{{ route('stuff.edit', $stuff->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a></td>
                                        <td><a href="{{ route('stuff.destroy', $stuff->id) }}"
                                                onclick="return confirm('Are you sure you want to delete this stuff?')"
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