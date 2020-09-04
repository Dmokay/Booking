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
                                <h4 class="card-title">Update Ages</h4>
                                <p class="card-description">

                                </p>
                                <form class="forms-sample" action="{{route('ages.store')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Minimum Age</label>
                                        <input type="text" class="form-control" required name="min" placeholder="Min Age"
                                        value="{{$age->min ?? ''}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Maximum Age</label>
                                        <input type="text" class="form-control" required name="max" placeholder="Max Age"
                                               value="{{$age->max ?? ''}}">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
