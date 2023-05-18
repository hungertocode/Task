<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class WebController extends Controller
{
    //

    public function index(Request $request)
    {
        $perPage = 5;

        $events = Events::with('artist', 'venue', 'genre');

        if ($request->has('search')) {
            
                $events=$events->whereRaw('lower(title) like ?', ['%' . $request->search . '%']);
        }

        $events=$events ->where(function ($query) use ($request) {

            if($request->has('search_venue'))
            {
                $search=strtolower($request->search_venue);

                $query->whereHas('venue', function ($subQuery) use ($search) {
                    $subQuery->whereRaw('LOWER(venue_name) LIKE ?', ['%' . $search . '%']);
                });
            }

            if($request->has('search_artist'))
            {
                $search=strtolower($request->search_artist);

                $query->WhereHas('artist', function ($subQuery) use ($search) {
                    $subQuery->whereRaw('LOWER(artist_name) LIKE ?', ['%' . $search . '%']);
                });
            }

            if($request->has('search_genre'))
            {
                $search=strtolower($request->search_genre);

                $query->WhereHas('genre', function ($subQuery) use ($search) {
                    $subQuery->whereRaw('LOWER(genre_name) LIKE ?', ['%' . $search . '%']);
                });
            }

        });

        if($request->has('search_date') && $request->search_date !="" )
        {
            $events=$events->whereDate('date',$request->search_date);
        }

        $events=$events->where(['is_active' => 1])->orderby('created_at', 'desc')->paginate($perPage);

        return view('frontend')->with(compact('events'));
    }
}
