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
                                    Services
                                    <a href="{{route('requests.create')}}" class="btn btn-sm btn-primary pull-right">Create Request</a>
                                </h4>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th style="font-weight: bolder">Name</th>
                                            <th style="font-weight: bolder">Phone No</th>
                                            <th style="font-weight: bolder">Service</th>
                                            <th style="font-weight: bolder">Max Attendance per Service</th>
                                            <th style="font-weight: bolder">Status</th>
                                            <th style="font-weight: bolder">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($requests as $request)
                                            <tr>
                                                <td>{{$request->name}}</td>
                                                <td>{{$request->phone_no}}</td>
                                                <td>{{$request->service}}</td>
                                                <td>100 attendees</td>
                                                <td>
                                                    {{$request->approved->count()." approved from ".$request->bookings->count(). " Requests"}}</td>
                                                <td>
                                                    <label class="badge {{$request->status ? 'badge-success': 'badge-danger'}}">
                                                        {{$request->status ? 'active': 'inactive'}}
                                                    </label>
                                                </td>
                                                <td>
                                                    <a href="{{route('requests.show', $request->id)}}"><i class="mdi mdi-arrow-expand"></i> </a>
                                                    <a href="" style="color: red"><i class="mdi mdi-bookmark-remove"></i> </a>
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
