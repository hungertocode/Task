<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Events;
use App\Models\Genre;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\DatatableScripting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class EventController extends Controller
{
    //
    public function index()
    {
        return view('events.index');
    }
    public function create(Request $request)
    {
        $genres = Genre::get();
        $artists = Artist::get();
        $venues = Venue::get();

        return view('events.create')->with(compact('genres', 'artists', 'venues'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validated_data = $request->validate([
            'title' => 'required',
            'genre_id' => 'required',
            'image' => 'required|max:2048',
            'short_description' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'venue_id' => 'required',
            'artist_id' => 'required',
            'is_active' => 'required'

        ]);


        DB::beginTransaction();
        try {

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                // $imagePath = $image->store('events', 'public');
                $imagePath = $image->store('public');
                $imagePath = str_replace('public/', '/events_img/', $imagePath);
                $validated_data['image'] = $imagePath;
            }

            // Create and save the event
            Events::create($validated_data);
            DB::commit();

            // return "success";

            return redirect()->route('events.index')->with('success', 'Event created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while saving the event. Please try again.');
        }
    }

    public function edit(Request $request, $event_id)
    {

        try {
            $id = decrypt($event_id);
            $events = Events::where(['event_id' => $id])->first();
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption error
            abort(404);
        }

        $genres = Genre::get();
        $artists = Artist::get();
        $venues = Venue::get();

        return view('events.create', compact('events', 'genres', 'artists', 'venues'));
    }

    public function update(Request $request, $event_id)
    {


        $validatedData = $request->validate([
            'title' => 'required',
            'genre_id' => 'required',
            'short_description' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'venue_id' => 'required',
            'artist_id' => 'required',
            'is_active' => 'required'
        ]);


        try {
            $id = decrypt($event_id);
            $event = Events::where(['event_id' => $id])->first();
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption error
            abort(403, "Some error occured");
        }


        if (is_null($event)) {

            return redirect()->route('events.edit', $event_id)->with('error', 'Invalid Id');
        }


        //Check whether the genre is same or not

        $check = Events::where('event_id', '!=', $id)->where($validatedData)->first();

        if ($check) {
            // return $validatedData;


            return redirect()->back()->with('error', 'This event is already present');
        }

        DB::beginTransaction();
        try {

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                // $imagePath = $image->store('events', 'public');
                $imagePath = $image->store('public');
                $imagePath = str_replace('public/', '/events_img/', $imagePath);
                $validatedData['image'] = $imagePath;
            }

            $validatedData['updated_at'] = Carbon::now();


            Events::where(['event_id' => $id])->update($validatedData);
            DB::commit();

            return redirect()->route('events.index')->with('success', 'event updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('events.edit', $event_id)->with('error', 'Some error occoured');
        }
    }
    public function destroy(Request $request, $event_id)
    {
        try {
            $id = decrypt($event_id);
            $data = Events::where(['event_id' => $id])->first();

            // Delete the associated image file
            if ($data) {

                $img_path = str_replace('/events_img/', 'public/', $data->image);
                Storage::delete($img_path);
            }
            Events::where(['event_id' => $id])->delete();

            return redirect()->back()->with(['success' => 'Successfully deleted']);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption error
            return redirect()->back()->with(['error' => 'Some error occured']);
        }
    }

    //Server Side scripting

    public function eventsQuery()
    {
        return  Events::leftJoin('artists', 'events.artist_id', '=', 'artists.artist_id')
            ->leftJoin('venues', 'events.venue_id', '=', 'venues.venue_id');
    }


    public function eventList(Request $request)
    {
        $column[0] = ['event_id', 'title', 'artist_name', 'venue_name', 'amount', 'date', 'is_active', 'view'];
        $column[1] = ['events', 'events', 'artists', 'venues', 'events', 'events', 'events', 'ignore'];


        $d = new DatatableScripting();

        $parentQuery = $d->parentQuery($request, $column, $this->eventsQuery($request));
        $dataQuery = $d->ServerSideScripting($column, $this->eventsQuery($request), $request);



        $data = array();

        $dataQuery=$dataQuery->select('events.event_id','events.title','artists.artist_name','venues.venue_name','events.amount','events.date','events.is_active');
        // return $parentQuery->get();

        foreach ($dataQuery->get() as $item) {
            $sub_data = array();
            $sub_data['event_id'] = $item->event_id ?? '-';
            $sub_data['title'] = ucfirst(strtolower($item->title)) ?? '-';
            $sub_data['artist_name'] = ucfirst(strtolower($item->artist_name)) ?? '-';
            $sub_data['venue_name'] = ucfirst(strtolower($item->venue_name)) ?? '-';
            $sub_data['amount'] = $item->amount ?? '-';
            $sub_data['date'] = $item->date ? Carbon::parse($item->date)->format('d/m/Y') : '';

            $sub_data['is_active'] = $item->is_active==1? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
            $script = "$('#delete_modal').modal('show');$('#delete_form').attr('action','/events/delete/" . encrypt($item->event_id) . "')";
            $sub_data['view'] = '<a  href="/events/edit/' . encrypt($item->event_id) . '" class="btn btn-sm btn-gray btn-icon mr-2" title="View details">Edit </a>
             
             <a   class="btn btn-sm btn-danger btn-icon mr-2" title="View details" onclick="' . $script . '">Delete </a>';
            $data[] = $sub_data;
        }

        $output = array(
            "draw"  =>  intval($request->draw ?? 1),
            "recordsTotal" =>  $parentQuery->count(),
            "recordsFiltered" =>  $parentQuery->count(),
            "data"  =>  $data
        );

        return response()->json($output);
    }

   
}
