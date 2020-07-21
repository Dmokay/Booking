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
                                <h4 class="card-title">{{$service->title}}
                                    ({{$service->approved_lower_deck->count() + $service->approved_upper_deck->count()}}
                                    / {{$service->total_max}} approved)</h4>
                                <p class="card-description">when: <strong>{{$service->when}}</strong></p>
                                <p class="card-description">Max Attendance: <strong>{{$service->total_max}}</strong></p>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('services.show', [$service->id])}}"
                                           role="tab">
                                            Approved ({{$service->approved_lower_deck->count() ." -lower, " . $service->approved_upper_deck->count()." - upper"}})
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active"
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
                                            <input type="hidden" name="tab" value="requested">
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
                                                <label for="exampleInputUsername1">Status</label>
                                                <select class="form-control-sm form-control" name="status">
                                                    <option selected value="">All</option>
                                                    <option value="0">Pending</option>
                                                    <option value="-1">Rejected</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="exampleInputUsername1">Search</label>
                                                <button type="submit" class="btn btn-primary mr-2 form-control">Search
                                                </button>
                                            </div>
                                        </div>
                                        <hr>
                                    </form>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped table-sm">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Attendees</th>
                                                <th>Deck</th>
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
                                                    <td>{{$booking->deck}}</td>
                                                    <td>
                                                        <label
                                                            class="badge {{$booking->status == 0 ? 'badge-info': 'badge-danger'}}">
                                                            {{$booking->status == 0 ? 'pending': 'rejected'}}
                                                        </label>
                                                    </td>
                                                    <td>{{$booking->created_at}}</td>
                                                    <td>
                                                        @if($booking->status != 1)
                                                            <a data-toggle="modal" data-target="#approve_{{$booking->id}}"
                                                               style="color: green;cursor: pointer">approve</a> |
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="approve_{{$booking->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <form action="{{route('approve_request', [$booking->id, ])}}" method="post">
                                                                            @csrf
                                                                            <input type="hidden" name="status" value="1">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Approve Request?</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <label>OPTIONAL Preferred Seat No.</label>
                                                                            <input type="number" name="seat" value="{{$booking->seat}}" class="form-control">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if($booking->deck == 'upper_deck')
                                                            <a href="{{route('shift_deck', [$booking->id, 'deck'=>'lower_deck'])}}"
                                                               >Shift to Lower Deck</a> |
                                                        @endif
                                                        @if($booking->deck == 'lower_deck')
                                                            <a href="{{route('shift_deck', [$booking->id, 'deck'=>'upper_deck'])}}"
                                                               >Shift to Upper Deck</a> |
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
