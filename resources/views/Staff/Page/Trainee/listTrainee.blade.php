@extends('Staff.Layout.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="cpl-sm-12 col-md-6">
                        <h4 class="m-0 font-weight-bold text-primary">Trainee List
                            <!-- Topbar Search -->
                            <form action="{{ route('staff.trainee.search') }}" method="GET"
                                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                        placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2"
                                        name="search" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </h4>
                    </div>
                    <div class="cpl-sm-12 col-md-6">
                        <a href="{{ route('staff.trainee.add') }}" class="btn btn-primary btn-icon-split"
                            style="float: right;">
                            <span class="icon text-white-50">
                                <i class="fas fa-flag"></i>
                            </span>
                            <span class="text">Add</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Age</th>
                                <th>Date of Birth</th>
                                <th>Address</th>
                                <th>Education</th>
                                <th>Department</th>
                                <th>Main Programming Language</th>
                                <th>TOEIC Score</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        @foreach ($trainee as $key => $value)
                            <tbody>
                                <tr>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->username }}</td>
                                    <td>{{ $value->age }}</td>
                                    <td>{{ $value->DoB }}</td>
                                    <td>{{ $value->address }}</td>
                                    <td>{{ $value->education }}</td>
                                    <td>{{ $value->department }}</td>
                                    <td>{{ $value->main_programming_language }}</td>
                                    <td>{{ $value->toeic_score }}</td>
                                    <td>
                                        <a href="{{ asset('staff/trainee/update/' . $value->id) }}"
                                            class="btn btn-secondary btn-icon-split">
                                            <span class="icon text-white-10">
                                                <i class="fas fa-arrow-right"></i>
                                            </span>
                                            <span class="text">Update</span>
                                        </a>
                                        <a href="{{ asset('staff/trainee/delete/' . $value->id) }}"
                                            class="btn btn-danger btn-icon-split">
                                            <span class="icon text-white-10">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Delete</span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
