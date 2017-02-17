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
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <form action="find" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <h3>STEP 1: UPLOAD IMAGE</h3>
                                <div class="row control-group">
                                    <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label>IMAGE</label>
                                    {{-- <input type="hidden" name="MAX_FILE_SIZE" value="30000" /> --}}
                                    <input name="image" type="file" required data-validation-required-message="Please upload an image.">
                                    <p class="help-block text-danger"></p>
                                    @if(!empty($valid))
                                        <p class="text-danger">Previous file was invalid. Please enter a valid image file.</p>
                                    @endif
                                    </div>
                                </div>
                            <br>
                            <div id="success"></div>
                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <button type="submit" class="btn btn-success btn-lg">Send</button>
                                </div>
                            </div>
                        </form>
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
                <div class="col-lg-4 col-xs-12 page-scroll">
                    <center><a href="#contact" class="btn btn-lg btn-outline">
                        <i class="fa fa-envelope"></i> Contact Us
                    </a></center>
                </div>
            </div>
        </div>
    </section>
@endsection
