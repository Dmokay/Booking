@extends('layouts.main')

@section('content')
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                @include('layouts.includes.heading')
                <div class="row mt-4">
                    <div class="col-md-6 offset-3 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Edit Service</h4>
                                <p class="card-description">

                                </p>
                                <form class="forms-sample" action="{{route('services.update', $service->id)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Title*</label>
                                        <input type="text" class="form-control form-control-sm" required name="title" value="{{$service->title}}"
                                               placeholder="Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">When*</label>
                                        <input type="text" class="form-control form-control-sm" name="when" id="dated" value="{{$service->when}}"
                                               placeholder="When" required data-toggle="datetimepicker" data-target="#dated">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Max Attendees*</label>
                                        <input type="number" class="form-control form-control-sm" required name="count" value="{{$service->count}}"
                                               placeholder="Max Attendees">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Description</label>
                                        <textarea class="form-control form-control-sm" name="description">{{$service->description}}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button class="btn btn-light">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
