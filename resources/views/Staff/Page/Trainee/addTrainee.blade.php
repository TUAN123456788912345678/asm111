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
                        <form action="{{ route('staff.trainee.add') }}" method="POST" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            <fieldset>
                                <div>
                                    @csrf
                                    <label>Username:</label>
                                    <input type="text" class="form-control" name="username" value="{{ old('username') }}"
                                        placeholder="Username">
                                    <br>
                                    <label>Password:</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                    <br>
                                    <label>Name:</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                        placeholder="Full Name">
                                    <br>
                                    <label>Age:</label>
                                    <input type="text" class="form-control" name="age" value="{{ old('age') }}"
                                        placeholder="Age">
                                    <br>
                                    <label>Date of Birth:</label>
                                    <input type="text" class="form-control" name="DoB" value="{{ old('DoB') }}"
                                        placeholder="Date of Birth">
                                    <br>
                                    <label>Address:</label>
                                    <input type="text" class="form-control" name="address" value="{{ old('address') }}"
                                        placeholder="Address">
                                    <br>
                                    <label>Education:</label>
                                    <input type="text" class="form-control" name="education" value="{{ old('education') }}"
                                        placeholder="Education">
                                    <br>
                                    <label>Department:</label>
                                    <input type="text" class="form-control" name="department" value="{{ old('department') }}"
                                        placeholder="Department">
                                    <br>
                                    <label>Main Programming Language:</label>
                                    <input type="text" class="form-control" name="main_programming_language" 
                                        value="{{ old('main_programming_language') }}" placeholder="Main Programming Language">
                                    <br>
                                    <label>TOEIC Score:</label>
                                    <input type="text" class="form-control" name="toeic_score" value="{{ old('toeic_score') }}"
                                        placeholder="TOEIC Score">
                                    <br>
                                </div>
                            </fieldset>
                            <button class="btn btn-primary btn-block text-uppercase mb-3" type="submit">
                                Add Trainee Account
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
