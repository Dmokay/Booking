@extends('layouts.main')

@section('content')
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                @include('layouts.includes.heading')
                <div class="row mt-4">
                    <div class="col-md-6 offset-3 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Create User</h4>
                                <p class="card-description">

                                </p>
                                <form class="forms-sample" action="{{route('users.store')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" required name="name" placeholder="Name"
                                        value="{{old('name')}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input type="email" class="form-control" required name="email" placeholder="Email"
                                               value="{{old('email')}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" required name="password" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label>Re-enter Password</label>
                                        <input type="password" class="form-control" required name="password_confirmation" placeholder="Re-Password">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
