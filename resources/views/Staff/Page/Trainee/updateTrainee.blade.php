@extends('Staff.Layout.master')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input!
            <br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-5 col-lg-5">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <form action="" method="POST" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            <fieldset>
                                <div>
                                    @csrf
                                    <label>Username:</label>
                                    <input type="text" class="form-control" name="username" value="{{ $trainee->username }}">
                                    <br>
                                    <label>Password:</label>
                                    <input type="password" class="form-control" name="password">
                                    <br>
                                    <label>Name:</label>
                                    <input type="text" class="form-control" name="name" value="{{ $trainee->name }}">
                                    <br>
                                    <label>Age:</label>
                                    <input type="text" class="form-control" name="age" value="{{ $trainee->age }}">
                                    <br>
                                    <label>Date of Birth:</label>
                                    <input type="text" class="form-control" name="DoB" value="{{ $trainee->DoB }}">
                                    <br>
                                    <label>Address:</label>
                                    <input type="text" class="form-control" name="address" value="{{ $trainee->address }}">
                                    <br>
                                    <label>Education:</label>
                                    <input type="text" class="form-control" name="education" value="{{ $trainee->education }}">
                                    <br>
                                    <label>Department:</label>
                                    <input type="text" class="form-control" name="department" value="{{ $trainee->department }}">
                                    <br>
                                    <label>Main Programming Language:</label>
                                    <input type="text" class="form-control" name="main_programming_language" value="{{ $trainee->main_programming_language }}">
                                    <br>
                                    <label>TOEIC Score:</label>
                                    <input type="text" class="form-control" name="toeic_score" value="{{ $trainee->toeic_score }}">
                                    <br>
                                </div>
                            </fieldset>
                            <button class="btn btn-primary btn-block text-uppercase mb-3" type="submit">
                                Update Trainee Account
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
