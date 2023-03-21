@extends('Staff.Layout.master')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="cpl-sm-12 col-md-6">
                        <h4 class="m-0 font-weight-bold text-primary">You searched for: {{ $search }}</h4>
                    </div>
                    <div class="cpl-sm-12 col-md-6">
                        <a href="{{ route('staff.trainee.add') }}" class="btn btn-primary btn-icon-split" style="float: right;">
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
                        @if ($trainee->isNotEmpty())
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
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
