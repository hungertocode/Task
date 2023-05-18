@extends('includes.main',['title'=>'Artist'])

@section('content')
    <div class="container">
        <h1>{{($artist??false)?'Edit':'Create'}} Artist</h1>
        <form action="{{ ($artist??false)?route('artists.update',encrypt($artist->artist_id)):route('artists.store') }}" method="POST">
            @csrf
            @if($artist??false)
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="artist_name">Name</label>
                <input type="text" name="artist_name" id="artist_name" class="form-control" value="{{ old('artist_name')??(($artist??false)?$artist->artist_name:'') }}" required>
                @error('artist_name')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="is_active">Status</label>
                <select name="is_active" id="is_active" class="form-control" required>
                    <option value="1" {{($artist??false)?($artist->is_active==1?'selected':''):'selected'}}>Active</option>
                    <option value="0" {{($artist??false)?($artist->is_active==0?'selected':''):''}}>Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-gray">{{($artist??false)?'Update':'Create'}} Artist</button>
        </form>
    </div>
@endsection
