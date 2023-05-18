@extends('includes.main',['title'=>'Venue'])


@section('content')
    @include('includes.success_msg')

    <div class="container">
        <h1>{{($venue??false)?'Edit':'Create'}} Venue</h1>
        <form action="{{ ($venue??false)?route('venues.update',encrypt($venue->venue_id??'')):route('venues.store') }}" method='POST'>
            @csrf
            @if($venue??false)
                @method('PUT')
            @endif
            <div class="form-group row">
                <label for="venue_name" class="col-4">Name</label>
                <input type="text" name="venue_name" id="venue_name" class="form-control col-8" value="{{ old('venue_name')??(($venue??false)?$venue->venue_name:'') }}" required>
                @error('venue_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            </div>

            <div class="form-group row">
                <label for="venue_address" class="col-4">Venue Adress</label>
                <input type="text" name="venue_address" id="venue_address" class="form-control col-8" value="{{ old('venue_address')??(($venue??false)?$venue->venue_address:'') }}" required>
                @error('venue_address')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            </div>
            <div class="form-group row">
                <label for="contact_number" class="col-4">Contact_number Number</label>
                <input type="text" name="contact_number" id="contact_number" class="form-control col-8" value="{{ old('contact_number')??(($venue??false)?$venue->contact_number:'') }}" required>
                @error('contact_number')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
            </div>
            <div class="form-group row">
                <label for="is_active" class="col-4">Status</label>
                <select name="is_active" id="is_active" class="form-control col-8" required>
                    <option value="1" {{($venue??false)?($venue->is_active?'selected':''):'selected'}}>Active</option>
                    <option value="0" {{($venue??false)?($venue->is_active?'':'selected'):''}}>Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-gray">{{($venue??false)?'Update':'Create'}} Venue</button>
        </form>
    </div>
@endsection
