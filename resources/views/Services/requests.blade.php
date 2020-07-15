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
                                <h4 class="card-title">{{$service->title}} ({{$service->approved->count()}} / 100 approved)</h4>
                                <p class="card-description">on {{$service->when}}</p>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('services.show', [$service->id])}}" role="tab">
                                            Approved Attendees ({{$service->approved->count()}})
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{route('services.show', [$service->id, 'tab'=>'requested'])}}" role="tab">
                                            Requests ({{$service->pending->count() + $service->rejected->count()}})
                                        </a>
                                    </li>
                                </ul>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Attendees</th>
                                                <th>Status</th>
                                                <th>Requested At</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data as $booking)
                                                <tr>
                                                    <td>{{$booking->names}}</td>
                                                    <td>{{$booking->phone}}</td>
                                                    <td>{{$booking->count}}</td>
                                                    <td>
                                                        <label
                                                            class="badge {{$booking->status == 0 ? 'badge-info': 'badge-danger'}}">
                                                            {{$booking->status == 0 ? 'pending': 'rejected'}}
                                                        </label>
                                                    </td>
                                                    <td>{{$booking->created_at}}</td>
                                                    <td>
                                                        @if($booking->status != 1)
                                                            <a href="{{route('approve_request', [$booking->id, 'status'=>1])}}"
                                                               style="color: green">approve</a> |
                                                        @endif
                                                        @if($booking->status != -1)
                                                            <a href="{{route('approve_request', [$booking->id, 'status'=>-1])}}"
                                                               style="color: red">reject</a>
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
    </div>
@endsection