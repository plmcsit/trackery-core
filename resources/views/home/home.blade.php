@extends('template.template')

@section('title')
    Trackery - HOME
@endsection

@section('page-image')
    <img class="img-responsive" src="img/png/profile.png" alt="trakery">
@endsection

@section('intro')
    <small>HI I'M</small><br>TRACKERY
@endsection

@section('navbar')
    <li class="hidden">
        <a href="#"></a>
    </li>
    <li class="page-scroll">
        <a href="#find">Find</a>
    </li>
    <li class="page-scroll">
        <a href="#found">Found</a>
    </li>
@endsection

@section('content')
    <!-- Find Section -->
    <section id="find">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>FIND</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2 col-xs-12">
                    <p style="text-align: justify">
                            Are you looking for someone but you're too far from the police station and you didn't know where to call for help?
                    </p>
                </div>
                <div class="col-lg-4 col-xs-12">
                    <p>
                        I can help you find someone that has been missing.<br>
                    </p>
                </div>
                <div class="col-lg-8 col-lg-offset-2 col-xs-12 text-center">
                    <h3 style="color: #18BC9C">Find them now!</h3>
                </div>
                <div class="col-lg-8 col-lg-offset-2 col-xs-12 text-center">
                    <p>My intelligence can help you using my FIND Module.</p>
                    <p>Click the button below to start.</p>
                    <a href="/find" class="btn btn-lg btn-primary">
                        <i class="fa fa-binoculars"></i> Start Finding Someone
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Found Section -->
    <section class="primary" id="found">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Found</h2>
                    <hr class="star-light-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2 col-xs-12">
                    <p style="text-align: justify">
                            Found someone missing and you don't know who to approach?
                    </p>
                </div>
                <div class="col-lg-4 col-xs-12">
                    <p style="text-align: justify">
                        Let me help you connect them to their love ones by registering them to my brain.<br>
                    </p>
                </div>
                <div class="col-lg-8 col-lg-offset-2 col-xs-12 text-center">
                    <h3 style="color: #18BC9C">Report a missing person now!</h3>
                </div>
                <div class="col-lg-8 col-lg-offset-2 col-xs-12 text-center">
                    <p>By reporting a missing person you might help someone find their love ones.</p>
                    <p>Click the button below to start.</p>
                    <a href="/found" class="btn btn-lg btn-outline">
                        <i class="fa fa-photo"></i> Report Missing Person
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection