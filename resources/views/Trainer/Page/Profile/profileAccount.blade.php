@extends('Trainer.Layout.master')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-5 col-lg-5">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <h4 class="m-0 font-weight-bold text-primary">
                            {{ $account->name }} Account Information
                        </h4>
                        <br>
                        <form role="form" enctype="multipart/form-data">
                            <table class="table table-nobordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name:</th>
                                        <th>{{ $account->name }}</th>
                                    </tr>
                                    <tr>
                                        <th>Type:</th>
                                        <th>{{ $account->type }}</th>
                                    </tr>
                                    <tr>
                                        <th>Department:</th>
                                        <th>{{ $account->department }}</th>
                                    </tr>
                                    <tr>
                                        <th>Phone Number:</th>
                                        <th>{{ $account->phone }}</th>
                                    </tr>
                                    <tr>
                                        <th>E-mail:</th>
                                        <th>{{ $account->email }}</th>
                                    </tr>
                                </thead>
                            </table>
                            <br>
                            <a class="btn btn-primary btn-block text-uppercase mb-3" href="{{ route('trainer.profile.update') }}">
                                Update Account Information
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
