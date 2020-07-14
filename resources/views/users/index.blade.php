@extends('layouts.main')

@section('content')
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                @include('layouts.includes.heading')
                <div class="row mt-4">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    Users
                                    <a href="{{route('users.create')}}" class="btn btn-sm btn-primary pull-right">Create
                                        User</a>
                                </h4>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th style="font-weight: bolder">Name</th>
                                            <th style="font-weight: bolder">Email</th>
                                            <th style="font-weight: bolder">Status</th>
                                            <th style="font-weight: bolder">Created At</th>
                                            <th style="font-weight: bolder">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>
                                                    <label
                                                        class="badge {{$user->status ? 'badge-success':  'badge-error'}}">
                                                        {{$user->status ? 'active':  'suspended'}}
                                                    </label>
                                                </td>
                                                <td>{{$user->created_at}}</td>
                                                <td>
                                                    @if($user->status)
                                                        <a href="#"><i class="mdi mdi-delete" style="color: red"></i></a>
                                                    @else
                                                        <a href="#"><i class="mdi mdi-check" style="color: green"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
