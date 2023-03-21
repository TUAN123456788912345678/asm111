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
                                    <label>Course:</label>
                                    <select name="course_id" class="form-control">
                                        @foreach ($course as $courses)
                                            <option value="{{ $courses->id }}">{{ $courses->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <label>Trainee:</label>
                                    <select name="trainee_id" class="form-control">
                                        @foreach ($trainee as $trainees)
                                            <option value="{{ $trainees->id }}">{{ $trainees->name }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                </div>
                            </fieldset>
                            <button class="btn btn-primary btn-block text-uppercase mb-3" type="submit">
                                Assign Course
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
