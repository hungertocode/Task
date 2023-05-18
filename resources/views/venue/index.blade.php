@extends('includes.main',['title'=>'Venue'])


@section('content')
    <div class="container">
    @if(Session('success'))
        <div class="alert alert-success text-center">{{session('success')}}</div>
    @endif
        <h1>Venues</h1>
        <div class="row text-end justify-content-end m-1">

            <a href="{{ route('venues.create') }}" class="btn col-auto btn-gray mb-2  ">Create Venue</a>
        </div>

        <table class="table" id="venue_table">
            <thead>
                <tr>
                    <th>Venue Id</th>
                    <th>Venue Name</th>
                    <th>Venue Address</th>
                    <th>Contact Number</th>

                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            
            </tbody>
        </table>
    </div>
@endsection

@section('js')

<script src="/js/venue.js"></script>

@endsection