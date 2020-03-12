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
        <div class="col-md-12">
            <div class="tile">
                <br>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Requested For</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($demands as $demand)
                                <tr>
                                    <td>{{ ucfirst($demand->name) }}</td>
                                    <td>{{ ucfirst($demand->email)  }}</td>
                                    <td>{{ $demand->phone }}</td>
                                    <td>{{ $demand->service->name ?? 'Callback' }}</td>
                                    <td>{{ ucfirst($demand->status) }}</td>
                                    <td>
                                        <div class="dropdown d-inline">
                                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Change Status
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    @if($demand->status != 'pending')
                                                        <a href="{{ route('changeStatus',[$demand->id,'pending']) }}" onclick="return confirm('Are you confirm to change status?')"> Pending</a>
                                                    @endif
                                                </li>
                                                <li>
                                                    @if($demand->status != 'responded')
                                                        <a href="{{ route('changeStatus',[$demand->id,'responded']) }}" onclick="return confirm('Are you confirm to change status?')"> Responded</a>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                        @if($demand->service_id != null)
                                        <a href="{{ route('request.show',$demand->id) }}" class="btn btn-sm btn-info">Details</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
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
