@extends('layouts.main')

@section('content')

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                @include('layouts.includes.heading')
                <div class="row mt-4">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-12 flex-column d-flex stretch-card">
                                    <div class="row">
                                        <div class="col-lg-3 d-flex grid-margin stretch-card">
                                            <div class="card sale-diffrence-border">
                                                <div class="card-body">
                                                    <h3 class="font-weight-bold mb-3">{{$requests_today}}</h3>
                                                    <p class="pb-0 mb-0">Requests Received Today</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 d-flex grid-margin stretch-card">
                                            <div class="card sale-diffrence-border">
                                                <div class="card-body">
                                                    <h2 class="text-dark mb-2 font-weight-bold">{{$approved_today}}</h2>
                                                    <h4 class="pb-0 mb-0">Requests Approved Today</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 d-flex grid-margin stretch-card">
                                            <div class="card sale-diffrence-border">
                                                <div class="card-body">
                                                    <h2 class="text-dark mb-2 font-weight-bold">{{$rejected_today}}</h2>
                                                    <h4 class="pb-0 mb-0">Requests Rejected Today</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 d-flex grid-margin stretch-card">
                                            <div class="card sale-diffrence-border">
                                                <div class="card-body">
                                                    <h2 class="text-dark mb-2 font-weight-bold">{{$services}}</h2>
                                                    <h4 class="pb-0 mb-0">Upcoming Services</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                {{--<div class="row mt-4">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <h4 class="card-title">Preffered Service Session</h4>
                                        <canvas id="salesDifference"></canvas>

                                    </div>
                                    <div class="col-lg-3">
                                        <h4 class="card-title">% of Approved Sessions</h4>
                                        <canvas id="salesDifference"></canvas>

                                    </div>

                                    <div class="col-lg-3">
                                        <h4 class="card-title">% of Declined Sessions</h4>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <ul class="graphl-legend-rectangle">
                                                    <li><span class="bg-danger"></span>Automotive</li>
                                                    <li><span class="bg-warning"></span>Books</li>
                                                    <li><span class="bg-info"></span>Software</li>
                                                    <li><span class="bg-success"></span>Video games</li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-8 grid-margin">
                                                <canvas id="bestSellers"></canvas>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-3">
                                        <h4 class="card-title">Weekly Attendance Statistics</h4>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="progress progress-lg grouped mb-2">
                                                    <div class="progress-bar  bg-danger" role="progressbar"
                                                         style="width: 40%" aria-valuenow="25" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                    <div class="progress-bar bg-info" role="progressbar"
                                                         style="width: 10%" aria-valuenow="50" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                    <div class="progress-bar bg-warning" role="progressbar"
                                                         style="width: 20%" aria-valuenow="50" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                         style="width: 30%" aria-valuenow="50" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <ul class="graphl-legend-rectangle">
                                                    <li><span class="bg-danger"></span>Instagram (15%)</li>
                                                    <li><span class="bg-warning"></span>Facebook (20%)</li>
                                                    <li><span class="bg-info"></span>Website (25%)</li>
                                                    <li><span class="bg-success"></span>Youtube (40%)</li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>--}}

            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="footer-wrap">
                    <div class="w-100 clearfix">
                        <span class="d-block text-center text-sm-left d-sm-inline-block"></span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Liberty Breeze Global
                            Systems</span>
                    </div>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->


@endsection
