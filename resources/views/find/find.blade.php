@extends('template.template')

@section('title')
    Trackery - FINDING
@endsection

@section('intro')
    FINDING MODULE
@endsection

@section('navbar')
    <li class="hidden">
        <a href="#"></a>
    </li>
    <li class="page-scroll">
        <a href="#find">Start Finding</a>
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
                    <h2>START FINDING</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
            
            </div>
        </div>
    </section>

    <!-- Found Section -->
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
                        <i class="fa fa-photo"></i> Home Page
                    </a></center>
                </div>
                <div class="col-lg-4 col-xs-12">
                    <center><a href="/found" class="btn btn-lg btn-outline">
                        <i class="fa fa-photo"></i> Found Page
                    </a></center>
                </div>
                <div class="col-lg-4 col-lg-offset-2 col-xs-12">
                    <center><a href="https://www.github.com/PLMCSIT/trackery-core" class="btn btn-lg btn-outline">
                        <i class="fa fa-photo"></i> Github Page
                    </a></center>
                </div>
                <div class="col-lg-4 col-xs-12">
                    <center><a href="/home/#contact" class="btn btn-lg btn-outline">
                        <i class="fa fa-photo"></i> Contact Us
                    </a></center>
                </div>
            </div>

        </div>
    </section>
@endsection
