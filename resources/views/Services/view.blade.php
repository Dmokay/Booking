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
                                <h4 class="card-title">{{$service->title}} ({{$service->approved_lower_deck->count() + $service->approved_upper_deck->count()}}
                                    / {{$service->total_max}} approved)</h4>
                                <p class="card-description">when: <strong>{{$service->when}}</strong></p>
                                <p class="card-description">Max Attendance: <strong>{{$service->total_max}}</strong></p>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{route('services.show', [$service->id])}}"
                                           role="tab">
                                            Approved ({{$service->approved_lower_deck->count() ." -lower, " . $service->approved_upper_deck->count()." - upper"}})
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                           href="{{route('services.show', [$service->id, 'tab'=>'requested'])}}"
                                           role="tab">
                                            Requests ({{$service->pending->count() + $service->rejected->count()}})
                                        </a>
                                    </li>
                                </ul>
                                <div class="col-md-12">
                                    <form class="forms-sample" action="{{route('services.show', [$service->id])}}"
                                          method="get">
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <label for="exampleInputUsername1">Phone</label>
                                                <input type="text" class="form-control form-control-sm" name="phone"
                                                       placeholder="Phone">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="exampleInputUsername1">Name</label>
                                                <input type="text" class="form-control form-control-sm" name="names"
                                                       placeholder="Names">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="exampleInputUsername1">search</label>
                                                <button type="submit" class="btn btn-primary mr-2 form-control">Search
                                                </button>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="exampleInputUsername1">Export</label>
                                                <a href="{{route('services.show', [$service->id, 'export'=>true])}}"
                                                   class="btn btn-primary mr-2 form-control">Export ALL as Excel</a>
                                            </div>
                                        </div>
                                        <hr>
                                    </form>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-sm table-striped">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                                <th>Deck</th>
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
                                                    <td>{{$booking->deck}}</td>
                                                    <td>{{$booking->seat}}</td>
                                                    <td>{{$booking->created_at}}</td>
                                                    <td>{{$booking->updated_at}}</td>
                                                    <td>
                                                        <a href="{{route('approve_request', [$booking->id, 'status'=>-1])}}"
                                                           style="color: red">cancel</a>
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
