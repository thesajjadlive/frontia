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
            <li class="breadcrumb-item active"><a href="{{ route('service.index') }}">{{ $title }}</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="col-md-12 row">
                    <a href="{{ route('service.create') }}" class="btn btn-primary">Add New {{ $title }}</a>
                </div>
                <br>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                            <tr>
                                    <td>{{ ucfirst($service->title) }}</td>
                                    <td>{{ ucfirst($service->category->name) }}</td>
                                    <td>{{ ucfirst($service->type) }}</td>
                                    <td>
                                        @if($service->deleted_at == null)
                                        <span class="text-success">Active</span>
                                        @else
                                        <span class="text-danger">Inactive</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($service->deleted_at == null)
                                            <a href="{{ route('service.show',$service->slug) }}" class="btn btn-sm btn-info"><i class="fa fa-info"></i></a>
                                            <a href="{{ route('service.edit',$service->slug) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('service.destroy',$service->slug) }}" method="post" style="display: inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Are you sure to delete?')"><i class="fa fa-trash"></i></button>
                                            </form>
                                        @else
                                            <form action="{{ route('service.restore',$service->id) }}" method="post" style="display: inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Do you want this back?')"><i class="fa fa-undo"></i></button>
                                            </form>

                                            <form action="{{ route('service.delete',$service->id) }}" method="post" style="display: inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirm to permanently remove?')"><i class="fa fa-trash"></i></button>
                                            </form>
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
