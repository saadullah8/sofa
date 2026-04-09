@extends('layout.admin')
@section('content')
    <div class="row">
        <!-- ============================================================== -->
        <!-- Contact Table  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Contact Messages</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $contact)
                                    <tr>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->subject }}</td>
                                        <td>
                <a href="{{ route('contact.show', $contact->id) }}"
                   class="btn btn-info btn-sm">View</a>
            </td>
                                       <td><a href="{{ route('contact.destroy', $contact->id) }}"
                                                onclick="return confirm('Are you sure you want to delete this contact?')"
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
        <!-- end Contact Table  -->
        <!-- ============================================================== -->
    </div>
@endsection