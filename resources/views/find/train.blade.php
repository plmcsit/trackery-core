@extends('template.template')

@section('title')
    Trackery - FINDING
@endsection

@section('page-image')
    <img class="img-responsive" src="img/png/map.png" alt="trakery" style="width:20%;height:20%;">
@endsection

@section('intro')
    @if(!empty($uploaded))
        IMAGE UPLOADED!
    @else
        FINDING MODULE
    @endif
@endsection

@section('navbar')
    <li class="hidden">
        <a href="#"></a>
    </li>
    <li class="page-scroll">
        @if(!empty($result))
            <a href="#find">Information</a>
        @else
            <a href="#find">Start Finding</a>
        @endif
    </li>
    <li class="page-scroll">
        <a href="#directories">Directories</a>
    </li>
@endsection

@section('content')
    <!-- Find Section -->
    <section id="find">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    @if(!empty($result))
                        <h2>INFORMATION</h2>
                    @else
                        <h2>START FINDING</h2>
                    @endif
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        @if(!empty($result))
                           <h3 style="color: #18bc9c">Name:</h3><h2>{{$result[0]->name}}</h2>
                           <h3 style="color: #18bc9c">Last Seen at:</h3><h2>{{$result[0]->location}}</h2>
                           <h3 style="color: #18bc9c">Time and Date:</h3><h2>{{$result[0]->created_at}}</h2>
                           <h3 style="color: #18bc9c">Other Info:</h3><h2>{{$result[0]->message}}</h2>
                        <br>
                        <center><a href="/find" class="btn btn-success btn-lg">
                            <i class="fa fa-photo"></i> Try Again.
                        </a></center>
                        @else
                            <h1>NO IMAGE TO FIND!</h1>
                            <h3>Upload an image first on found module.</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Directories Section -->
    <section class="primary" id="directories">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>DIRECTORIES</h2>
                    <hr class="star-light-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2 col-xs-12">
                    <center><a href="/home" class="btn btn-lg btn-outline">
                        <i class="fa fa-home"></i> Home Page
                    </a></center>
                </div>
                <div class="col-lg-4 col-xs-12">
                    <center><a href="/found" class="btn btn-lg btn-outline">
                        <i class="fa fa-eye"></i> Found Page
                    </a></center>
                </div>
                <div class="col-lg-4 col-lg-offset-2 col-xs-12">
                    <center><a href="https://www.github.com/PLMCSIT/trackery-core" class="btn btn-lg btn-outline">
                        <i class="fa fa-github-alt"></i> Github Page
                    </a></center>
                </div>
                <div class="col-lg-4 col-xs-12">
                    <center><a href="/home/#contact" class="btn btn-lg btn-outline">
                        <i class="fa fa-envelope"></i> Contact Us
                    </a></center>
                </div>
            </div>
        </div>
    </section>
@endsection
