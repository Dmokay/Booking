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
                                    <a href="{{route('services.create')}}" class="btn btn-sm btn-primary pull-right">Create Service</a>
                                </h4>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th style="font-weight: bolder">Title</th>
                                            <th style="font-weight: bolder">Description</th>
                                            <th style="font-weight: bolder">Date</th>
                                            <th style="font-weight: bolder">Service Limit</th>
                                            <th style="font-weight: bolder">Attendance Count</th>
                                            <th style="font-weight: bolder">Status</th>
                                            <th style="font-weight: bolder">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($services as $service)
                                            <tr>
                                                <td>{{$service->title}}</td>
                                                <td>{{$service->description}}</td>
                                                <td>{{$service->when}}</td>
                                                <td>{{$service->count}} attendees</td>
                                                <td>
                                                    {{$service->approved->count()." approved from ".$service->bookings->count(). " Requests"}}</td>
                                                <td>
                                                    <label class="badge {{$service->status ? 'badge-success': 'badge-danger'}}">
                                                        {{$service->status ? 'active': 'inactive'}}
                                                    </label>
                                                </td>
                                                <td>
                                                    <a href="{{route('services.show', $service->id)}}"><i class="mdi mdi-arrow-expand"></i> </a>
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
