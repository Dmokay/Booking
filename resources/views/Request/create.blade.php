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
                                <h4 class="card-title">Create Request</h4>
                                <p class="card-description">

                                </p>
                                <form class="forms-sample" action="" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Title</label>
                                        <input type="text" class="form-control" name="title" id="exampleInputUsername1"
                                               placeholder="Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">When</label>
                                        <input type="text" class="form-control" name="when" id="dated"
                                               placeholder="When" data-toggle="datetimepicker" data-target="#dated">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Description</label>
                                        <textarea class="form-control" name="description"></textarea>
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
