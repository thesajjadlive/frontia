@extends('layouts.backend.master')
@section('content')
    <!--title-->
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> {{ $title }}</h1>
            <p>Display {{ $title }} Data Effectively</p>
        </div>

        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('category.index') }}">{{ $title }}</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Information') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('about.insert')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('Video Image') }}</label>
                            <div class="col-md-6">

                                <input type="file" id="input-file-now-custom-1" name="image" class="dropify" @error('image') is-invalid @enderror data-default-file="@if(isset($abouts->image)){{asset($abouts->image)}}@else{{asset('uploads/default.jpg')}}@endif" data-max-file-size="2M"/>

                            </div>
                        </div>
                        <!--link-->
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Youtube Video Link') }}</label>

                            <div class="col-md-6">
                                <input id="video" type="text" class="form-control @error('video') is-invalid @enderror" name="video" value="@if (isset($abouts->video)){{$abouts->video}}@endif" required autocomplete="video">
                                @error('video')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!--quote-->
                        <div class="form-group row">
                            <label for="embed-map" class="col-md-4 col-form-label text-md-right">{{ __('Quote Text') }}</label>
                            <div class="col-md-6">
                                <textarea name="quote" id="" class="form-control" rows="3" required>@if(isset($abouts->quote)){{ $abouts->quote}}@endif</textarea>
                            </div>
                        </div>

                        <!--about-->
                        <div class="form-group row">
                            <label for="embed-map" class="col-md-4 col-form-label text-md-right">{{ __('About Us Text') }}</label>
                            <div class="col-md-6">
                                <textarea name="about" id="" class="form-control" rows="6" required>@if(isset($abouts->about)){{ $abouts->about}}@endif</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Counter Information') }}</label>

                            <div class="col-md-3">
                            <label for="address" class="col-form-label text-md-right">{{ __('Project Completed') }}</label>
                                <input id="project" type="number" class="form-control @error('project') is-invalid @enderror" name="project" value="@if (isset($abouts->project)){{$abouts->project}}@endif" required autocomplete="project">
                                @error('project')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="address" class="col-form-label text-md-right">{{ __('Happy Customer') }}</label>
                                <input id="customer" type="number" class="form-control @error('customer') is-invalid @enderror" name="customer" value="@if (isset($abouts->customer)){{$abouts->customer}}@endif" required autocomplete="customer">
                                @error('customer')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="address" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-3">
                                <label for="address" class="col-form-label text-md-right">{{ __('Positive Review') }}</label>
                                <input id="review" type="number" class="form-control @error('review') is-invalid @enderror" name="review" value="@if (isset($abouts->review)){{$abouts->review}}@endif" required autocomplete="review">
                                @error('review')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="address" class="col-form-label text-md-right">{{ __('Followers') }}</label>
                                <input id="follower" type="number" class="form-control @error('follower') is-invalid @enderror" name="follower" value="@if (isset($abouts->follower)){{$abouts->follower}}@endif" required autocomplete="follower">
                                @error('follower')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                @if (isset($abouts))
                                <button type="submit" class="btn btn-primary" id="update_contact">
                                    {{ __('Update') }}
                                </button>
                                @else
                                <button type="submit" class="btn btn-primary" id="insert_contact">
                                    {{ __('Insert') }}
                                </button>
                                @endif


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('library-css')
    <!-- dropify CSS-->
    <link rel="stylesheet" href="{{asset('backend/dropify/css/dropify.min.css')}}">
@endpush



@push('custom-css')
    <style>
        .dropify-wrapper{
            height: 120px;
        }
    </style>
@endpush


@push('library-js')
    <!-- dropify JS-->
    <script src="{{asset('backend/dropify/js/dropify.min.js')}}"></script>
@endpush



@push('custom-js')
    <script>
        $(document).ready(function(){
            // Basic
            $('.dropify').dropify();
        });
    </script>
@endpush
