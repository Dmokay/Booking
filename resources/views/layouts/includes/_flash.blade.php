@if (session('status'))
    <div class="row" style="margin: 20px;width: 100%">
        <div class="col-md-12 text-center alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            {{session('status')}}
        </div>
    </div>
@endif
@if (session('error'))
    <div class="row" style="margin: 20px;width: 100%">
        <div class="col-md-12 text-center alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Error!</h4>
            {{session('error')}}
        </div>
    </div>
@endif
@if (count($errors) > 0)
    <div class="row" style="margin: 20px;width: 100%">
        <div class="col-md-12 text-center alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i> <strong>Whoops!</strong> There were some problems with your input.
            </h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
