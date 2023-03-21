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
                                    <input type="text" class="form-control" name="username" value="{{ $trainer->username }}">
                                    <br>
                                    <label>Password:</label>
                                    <input type="password" class="form-control" name="password">
                                    <br>
                                    <label>Name:</label>
                                    <input type="text" class="form-control" name="name" value="{{ $trainer->name }}">
                                    <br>
                                    <label>Type:</label>
                                    <br>
                                    <select class="form-control" name="type">
                                        <option value="External">External</option>
                                        <option value="Internal">Internal</option>
                                    </select>
                                    <br>
                                    <label>Department:</label>
                                    <input type="text" class="form-control" name="department" value="{{ $trainer->department }}">
                                    <br>
                                    <label>Phone Number:</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $trainer->phone }}">
                                    <br>
                                    <label>E-mail:</label>
                                    <input type="text" class="form-control" name="email" value="{{ $trainer->email }}">
                                    <br>
                                </div>
                            </fieldset>
                            <button class="btn btn-primary btn-block text-uppercase mb-3" type="submit">
                                Update Trainer Account
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
