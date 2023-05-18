@extends('includes.main')

@section('content')

<div class="container">

@include('includes.success_msg')

<form  action="{{ ($events??false)?route('events.update',encrypt($events->event_id??'')):route('events.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @if($events??false)
        @method('PUT')
    @endif
    
    <div class="form-group mt-3 mb-3">
        <label for="title">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title')??(($events??false)?$events->title:'') }}" required>
        @error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group mt-3 mb-3">
        <label for="genre_id">Genre</label>
        <select class="form-control @error('genre_id') is-invalid @enderror" id="genre_id" name="genre_id" required>
            <option value="">Select Genre</option>
            <!-- Options for genres -->

            @foreach($genres as $item)
                <option value="{{$item->genre_id}}"  {{($events??false)?($events->genre_id===$item->genre_id?'selected':''):''}}>{{ucfirst(strtolower($item->genre_name))}}</option>
            @endforeach
        </select>
        @error('genre_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group mt-3 mb-3">
        <label for="image">Image</label>
        <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" {{($events??false)?'':'required'}}>

        @if($events??false)
            <div class="row">
                <img src="{{$events->image}}" class="w-50" alt="Event Image">
            </div> 
        @endif

        @error('image')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group mt-3 mb-3">
        <label for="short_description">Short Description</label>
        <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="3" required>{{ old('short_description')??(($events??false)?$events->short_description:'') }}</textarea>
        @error('short_description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group mt-3 mb-3">
        <label for="amount">Amount</label>
        <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount')??(($events??false)?$events->amount:'') }}" required>
        @error('amount')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group mt-3 mb-3">
        <label for="date">Date</label>
        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date')??(($events??false)?$events->date:'') }}" required>
        @error('date')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group mt-3 mb-3">
        <label for="venue_id">Venue</label>
        <select class="form-control @error('venue_id') is-invalid @enderror" id="venue_id" name="venue_id" required>
            <option value="">Select Venue</option>
            <!-- Options for venues -->
            @foreach($venues as $item)
                <option value="{{$item->venue_id}}"  {{($events??false)?($events->venue_id===$item->venue_id?'selected':''):''}}>{{ucfirst(strtolower($item->venue_name))}}</option>
            @endforeach
        </select>
        @error('venue_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group mt-3 mb-3">
        <label for="artist_id">Artist</label>
        <select class="form-control @error('artist_id') is-invalid @enderror" id="artist_id" name="artist_id" required>
            <option value="0">Select Artist</option>
            <!-- Options for artists -->
            @foreach($artists as $item)
                <option value="{{$item->artist_id}}"  {{($events??false)?($events->artist_id===$item->artist_id?'selected':''):''}}>{{ucfirst(strtolower($item->artist_name))}}</option>
            @endforeach
        </select>
        @error('artist_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mt-3 mb-3 ">
                <label for="is_active" class="col-4">Status</label>
                <select name="is_active" id="is_active" class="form-control col-8" required>
                    <option value="1" {{($events??false)?($events->is_active?'selected':''):'selected'}}>Active</option>
                    <option value="0" {{($events??false)?($events->is_active?'':'selected'):''}}>Inactive</option>
                </select>
            </div>

    <button type="submit" class="btn btn-gray">Submit Event</button>

</form>


</div>

@endsection