@extends('layouts.backend.master')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> {{ $title }}</h1>
            <p>Display {{ $title }} Data Effectively</p>
        </div>

        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="#">{{ $title }}</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-10">
            <div class="tile">
                <div class="col-md-12 row">
                    @if (Auth::user()->type !== 'operator')
                    <a href="{{ route('user.edit',Auth::user()->slug) }}" class="btn btn-sm btn-info">Edit Profile</a>
                    @endif
                </div>
                <br>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tr>
                                <th> </th>
                                <td><img class="img-fluid" style="max-width: 30%" src="{{ asset(Auth::user()->image != null? Auth::user()->image : 'uploads/user_default.jpg') }}"></td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ ucfirst(Auth::user()->name) }}</td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td>{{ ucfirst(Auth::user()->type) }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ Auth::user()->email }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ Auth::user()->phone }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




@push('library-css')

@endpush



@push('custom-css')

@endpush



@push('library-js')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush



@push('custom-js')
    <script type="text/javascript">
        if(document.location.hostname == 'pratikborsadiya.in') {
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-72504830-1', 'auto');
            ga('send', 'pageview');
        }
    </script>
@endpush
