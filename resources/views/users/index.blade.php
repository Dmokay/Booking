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
                                    <a href="{{route('users.create')}}" class="btn btn-sm btn-primary pull-right">Create User</a>
                                </h4>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th style="font-weight: bolder">Name</th>
                                            <th style="font-weight: bolder">Email</th>
                                            <th style="font-weight: bolder">Status</th>
                                            <th style="font-weight: bolder">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Jacob</td>
                                            <td>53275531</td>
                                            <td>12 May 2017</td>
                                            <td><label class="badge badge-danger">Pending</label></td>
                                        </tr>
                                        <tr>
                                            <td>Messsy</td>
                                            <td>53275532</td>
                                            <td>15 May 2017</td>
                                            <td><label class="badge badge-warning">In progress</label></td>
                                        </tr>
                                        <tr>
                                            <td>John</td>
                                            <td>53275533</td>
                                            <td>14 May 2017</td>
                                            <td><label class="badge badge-info">Fixed</label></td>
                                        </tr>
                                        <tr>
                                            <td>Peter</td>
                                            <td>53275534</td>
                                            <td>16 May 2017</td>
                                            <td><label class="badge badge-success">Completed</label></td>
                                        </tr>
                                        <tr>
                                            <td>Dave</td>
                                            <td>53275535</td>
                                            <td>20 May 2017</td>
                                            <td><label class="badge badge-warning">In progress</label></td>
                                        </tr>
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
