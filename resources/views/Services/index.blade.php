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
                                    <a href="{{route('services.create')}}" class="btn btn-sm btn-primary pull-right">Create
                                        Service</a>
                                </h4>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th style="font-weight: bolder">Title</th>
                                            <th style="font-weight: bolder">Description</th>
                                            <th style="font-weight: bolder">Date</th>
                                            <th style="font-weight: bolder">Service Limit (Upper,Lower) decks</th>
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
                                                <td>{{$service->upper_deck}} Upper Deck, {{$service->lower_deck}} Lower deck</td>
                                                <td>
                                                    {{$service->approved_lower_deck->count() + $service->approved_upper_deck->count()." approved from ".$service->bookings->count(). " Requests"}}</td>
                                                <td>
                                                    <label
                                                        class="badge {{$service->status ? 'badge-success': 'badge-danger'}}">
                                                        {{$service->status ? 'active': 'inactive'}}
                                                    </label>
                                                </td>
                                                <td>
                                                    <a href="{{route('services.show', $service->id)}}">view</a> |
                                                    <a href="{{route('services.edit', $service->id)}}">edit</a> |
                                                    @if($service->status)
                                                        <a href="{{route('toggle_service', $service->id)}}" style="color: red"> deactivate </a>
                                                    @else
                                                        <a href="{{route('toggle_service', $service->id)}}" style="color: green"> activate </a>
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
