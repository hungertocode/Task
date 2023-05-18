@extends('includes.main',['title'=>'Genre'])


@section('content')
    <div class="container main">
    @if(Session('success'))
        <div class="alert alert-success text-center">{{session('success')}}</div>
    @endif
        <h1>Genres</h1>
        <div class="row text-end justify-content-end m-1">

            <a href="{{ route('genres.create') }}" class="btn col-auto btn-gray mb-2  ">Create xGenre</a>
        </div>

        <table class="table" id="genre_table">
            <thead>
                <tr>
                    <th>Genre Id</th>
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
    <script src="/js/genre.js"></script>
@endsection