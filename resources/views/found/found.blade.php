@extends('template.template')

@section('title')
Trackery - FOUND
@endsection

@section('page-image')
    <img class="img-responsive" src="img/png/compass.png" alt="trakery" style="width:20%;height:20%;">
@endsection

@section('intro')
    @if(!empty($uploaded))
        @if($uploaded == "true")
            IMAGE UPLOADED!
        @else
            NO FACE FOUND!
        @endif
    @else
        FOUND MODULE
    @endif
    
@endsection

@section('message')
    
@endsection

@section('navbar')
    <li class="hidden">
        <a href="#"></a>
    </li>
    <li class="page-scroll">
        <a href="#find">Start Uploading</a>
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
                    <h2>START UPLOADING</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        @if($result == true)
                           <div class="col-sm-6 col-xs-12 portfolio-item">
                                <h3>EXISTING</h3>
                                <img src={{ $old_image }} class="img-responsive" alt="Old Image">
                            </div>
                            
                            <div class="col-sm-6 col-xs-12 portfolio-item">
                                <h3>ENHANCED</h3>
                                <img src={{ $new_image }} class="img-responsive" alt="New Image">
                            </div>
                        &nbsp; <br>
                        @endif
                        <form action="found" method="post" enctype="multipart/form-data">
                           {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
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
                            
                            <h3>STEP 2: ENTER INFORMATION</h3>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label>NAME</label>
                                    <input name="name" type="text" class="form-control" placeholder="Name (if available)" id="name">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>

                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label>LOCATION</label>
                                    <input name="location" type="text" class="form-control" placeholder="Location" id="location" required data-validation-required-message="Please enter the location where you found them.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>

                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label>MESSAGE</label>
                                    <textarea name="message" rows="2" class="form-control" placeholder="Message (optional)" id="message"></textarea>
                                    <p class="help-block text-danger"></p>
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
                        <i class="fa fa-home"></i> Home Page
                    </a></center>
                </div>
                <div class="col-lg-4 col-xs-12">
                    <center><a href="/find" class="btn btn-lg btn-outline">
                        <i class="fa fa-binoculars"></i> &nbsp;Find Page&nbsp;
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