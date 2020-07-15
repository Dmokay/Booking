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
                                <h4 class="card-title">{{$service->title}} ({{$service->approved->count()}} / {{$service->count}} approved)</h4>
                                <p class="card-description">when: <strong>{{$service->when}}</strong></p>
                                <p class="card-description">Max Attendance: <strong>{{$service->count}}</strong></p>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{route('services.show', [$service->id])}}" role="tab">
                                            Approved Attendees ({{$service->approved->count()}})
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('services.show', [$service->id, 'tab'=>'requested'])}}" role="tab">
                                            Requests ({{$service->pending->count() + $service->rejected->count()}})
                                        </a>
                                    </li>
                                </ul>
                                <div class="col-md-12">
                                    <div class="col-md-12" style="margin: 5px">
                                        <a href="{{route('services.show', [$service->id, 'export'=>true])}}" class="btn btn-sm btn-primary pull-right">Export as Excel</a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-sm table-striped">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                                <th>Seat</th>
                                                <th>Requested At</th>
                                                <th>approved At</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data as $booking)
                                                <tr>
                                                    <td>{{$booking->names}}</td>
                                                    <td>{{$booking->phone}}</td>
                                                    <td><label class="badge badge-success">Approved</label></td>
                                                    <td>{{$booking->seat}}</td>
                                                    <td>{{$booking->created_at}}</td>
                                                    <td>{{$booking->updated_at}}</td>
                                                    <td>
                                                        <a href="{{route('approve_request', [$booking->id, 'status'=>-1])}}" style="color: red">cancel</a>
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
    </div>
@endsection
