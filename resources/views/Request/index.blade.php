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
                                    Service Requests
                                </h4>
                                <form class="forms-sample" action="" method="get">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label for="exampleInputUsername1">Phone</label>
                                            <input type="text" class="form-control form-control-sm" name="phone"
                                                   placeholder="Phone">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="exampleInputUsername1">Name</label>
                                            <input type="text" class="form-control form-control-sm" name="names"
                                                   placeholder="Names">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="exampleInputUsername1">Service</label>
                                            <select class="form-control-sm form-control" name="service_id">
                                                <option selected value="">All</option>
                                                @foreach($services as $service)
                                                    <option value="{{$service->id}}">{{$service->title ."(". $service->when .")"}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="exampleInputUsername1">Status</label>
                                            <select class="form-control-sm form-control" name="status">
                                                <option selected value="">All</option>
                                                <option value="1">Approved</option>
                                                <option value="0">Pending</option>
                                                <option value="-1">Rejected</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="exampleInputUsername1">Search</label>
                                            <button type="submit" class="btn btn-primary mr-2 form-control">Search
                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                </form>
                                <div class="table-responsive">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Service</th>
                                                <th>Attendees</th>
                                                <th>Status</th>
                                                <th>Requested At</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($bookings as $booking)
                                                <tr>
                                                    <td>{{$booking->names}}</td>
                                                    <td>{{$booking->phone}}</td>
                                                    <td>{{$booking->service->title}}</td>
                                                    <td>{{$booking->count}}</td>
                                                    <td>
                                                        @if($booking->status == 0)
                                                            <label class="badge badge-info">pending</label>
                                                        @elseif($booking->status == 1)
                                                            <label class="badge badge-success">approved</label>
                                                        @else
                                                            <label class="badge badge-danger">rejected</label>
                                                        @endif
                                                    </td>
                                                    <td>{{$booking->created_at}}</td>
                                                    <td>
                                                        @if($booking->status != 1)
                                                            <a href="{{route('approve_request', [$booking->id, 'status'=>1])}}"
                                                               style="color: green">approve</a>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="booking_1{{$booking->id}}"
                                                                 tabindex="-1" role="dialog"
                                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLabel">You are about to
                                                                                update a record</h5>
                                                                            <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <form method="post"
                                                                              action="{{route('approve_request', $booking->id)}}">

                                                                            @csrf
                                                                            {{ method_field('UPDATE') }}

                                                                            <div class="modal-body">
                                                                                ...
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">Close
                                                                                </button>
                                                                                <button type="submit"
                                                                                        class="btn btn-danger">Update
                                                                                </button>
                                                                            </div>

                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            </div>

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






