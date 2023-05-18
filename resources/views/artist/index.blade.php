@extends('includes.main',['title'=>'Artist'])

@section('content')
    <div class="container">
    @if(Session('success'))
        <div class="alert alert-success text-center">{{session('success')}}</div>
    @endif
        <h1>Artists</h1>
        <div class="row text-end justify-content-end m-1">

            <a href="{{ route('artists.create') }}" class="btn col-auto btn-gray mb-2  ">Create Artist</a>
        </div>

        <table class="table" id="artist_table">
            <thead>
                <tr>
                    <th>Artist Id</th>
                    <th>Name</th>
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

    <script src="/js/artist.js"></script>
@endsection