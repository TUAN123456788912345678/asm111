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
                        <form action="{{ route('staff.topic.add') }}" method="POST" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            <fieldset>
                                <div>
                                    @csrf
                                    <label>Name:</label>
                                    <input type="text" class="form-control" name="name" placeholder="Topic Name">
                                    <br>
                                    <label>Description:</label>
                                    <textarea class="form-control" name="description"
                                    style="width: 100%; height:100px;" placeholder="Descrption"></textarea>
                                    <br>
                                    <label>Course:</label>
                                    <select name="course_id" class="form-control">
                                        @foreach ($course as $courses)
                                            <option value="{{ $courses->id }}">{{ $courses->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <br>
                                </div>
                            </fieldset>
                            <button class="btn btn-primary btn-block text-uppercase mb-3" type="submit">
                                Add Topic
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
