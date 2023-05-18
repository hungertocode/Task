@extends('includes.main',['title'=>'Genre'])


@section('content')
<div class="container">
    <h1>{{($genre??false)?'Edit':'Create'}} Genre</h1>
    <form action="{{ ($genre??false)?route('genres.update',encrypt($genre->genre_id)):route('genres.store') }}" method="POST">
        @csrf
        @if($genre??false)
        @method('PUT')
        @endif
        <div class="form-group">
            <label for="genre_name">Name</label>
            <input type="text" name="genre_name" id="genre_name" class="form-control" value="{{ old('genre_name')??(($genre??false)?$genre->genre_name:'') }}" required>
            @error('genre_name')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="is_active">Status</label>
            <select name="is_active" id="is_active" class="form-control" required>
                <option value="1" {{($genre??false)?($genre->is_active==1?'selected':''):'selected'}}>Active</option>
                <option value="0" {{($genre??false)?($genre->is_active==0?'selected':''):''}}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-gray">{{($genre??false)?'Update':'Create'}} Genre</button>
    </form>
</div>
@endsection