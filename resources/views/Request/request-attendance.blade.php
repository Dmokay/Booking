<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Makamu Evans">
    <meta name="keywords" content="Church">

    <!-- Title Page-->
    <title>Register to Attend Service</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
          rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
<div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
    <div class="wrapper wrapper--w680">
        <div class="card card-1">
            <div class="card-heading"></div>
            <div class="card-body">
                <h2 class="title">Register Below</h2>
                <form method="POST" action="{{route('requests.store')}}">
                    @csrf
                    <div class="input-group">
                        <div class="rs-select2 js-select-simple select--no-search">
                            <select name="service_id">
                                <option disabled="disabled" selected="selected">Select Service</option>
                                @foreach($services as $service)
                                    <option value="{{$service->id}}">{{$service->when}} -{{$service->title}}</option>
                                @endforeach
                            </select>
                            <div class="select-dropdown"></div>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="rs-select2 js-select-simple select--no-search">
                            <select name="attendees" onchange="countChange(this)">
                                <option disabled selected="selected">Select Number of Attendees</option>
                                <option value="1">1 Attendee</option>
                                <option value="2">2 Attendees</option>
                                <option value="3">3 Attendees</option>
                            </select>
                            <div class="select-dropdown"></div>
                        </div>
                    </div>
                    <div class="replica">

                    </div>
                    <div class="p-t-20">
                        <button class="btn btn--radius btn--green" type="submit">Submit</button>
                    </div>
                </form>

                <div style="display: none">
                    <div class="row row-space elm">
                        <div class="col-2">
                            <div class="input-group">
                                <input class="input--style-1" type="text" placeholder="NAME" required name="names[]">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group">
                                <input class="input--style-1" type="text" placeholder="PHONE" required name="phone[]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jquery JS-->
<script src="vendor/jquery/jquery.min.js"></script>
<!-- Vendor JS-->
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/datepicker/moment.min.js"></script>
<script src="vendor/datepicker/daterangepicker.js"></script>

<!-- Main JS-->
<script src="js/global.js"></script>

<script>
    function countChange(count) {
        var count_value = count.value;
        const div = $('.elm').clone();
        $('.replica').empty();
        if (count_value == 1)
            $('.replica').append($('.elm').clone().removeClass("elm"))
        else if (count_value == 2){
            $('.replica').append($('.elm').clone().removeClass("elm"));
            $('.replica').append($('.elm').clone().removeClass("elm"));
        } else if (count_value == 3){
            $('.replica').append($('.elm').clone().removeClass("elm"))
            $('.replica').append($('.elm').clone().removeClass("elm"))
            $('.replica').append($('.elm').clone().removeClass("elm"))
        }
    }
</script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
