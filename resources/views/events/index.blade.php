@extends('includes.main',['title'=>'Events'])

@section('content')
    <div class="container">
      @include('includes.success_msg')
        <h1>Events</h1>
        <div class="row text-end justify-content-end m-1">

            <a href="{{ route('events.create') }}" class="btn col-auto btn-gray mb-2  ">Create event</a>
        </div>

        <table class="table" id="event_table">
            <thead>
                <tr>
                    <th>Event Id</th>
                    <th>Title</th>
                    <th>Artist </th>
                    <th>Venue</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            
            </tbody>
        </table>
    </div>
@endsection

@section('js')

    <script src="/js/events.js"></script>
@endsection
