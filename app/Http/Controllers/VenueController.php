<?php

namespace App\Http\Controllers;

use App\Helpers\DatatableScripting;
use Illuminate\Http\Request;
use App\Models\Venue;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class VenueController extends Controller
{
    public function index()
    {
        $venues = Venue::all();

        return view('venue.index', compact('venues'));
    }

    public function create()
    {
        return view('venue.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'venue_name' => 'required',
            'venue_address'=>'required',
            'contact_number'=>'required|numeric|digits:10',
            'is_active' => 'boolean',
        ]);

        $check=Venue::where(strtolower('venue_name'),strtolower($request->venue_name))
        ->where(strtolower('venue_address'),strtolower($request->venue_address))->first();

        if($check)
        {   
          return redirect()->back()->with(['error'=>'This venue already added']);
        }

        DB::beginTransaction();
        try{

            Venue::create($validatedData);
            DB::commit();
            return redirect()->route('venues.index')->with('success', 'Venue created successfully.');

        }
        catch(Exception $e)
        {
            DB::rollBack();
            return redirect()->route('artists.index')->with('error', 'Some error occoured');

        }

    
    }

    public function edit(Request $request,$venue_id)
    {

        try {
            $id = decrypt($venue_id);
            $venue = Venue::where(['venue_id'=>$id])->first();
            
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption error
            abort(404);
        }

        return view('venue.create', compact('venue'));
    }

    public function update(Request $request,$venue_id)
    {
        $validatedData = $request->validate([
            'venue_name' => 'required',
            'venue_address'=>'required',
            'contact_number'=>'required|numeric|digits:10',
            'is_active' => 'boolean',
        ]);
     
        try {
            $id = decrypt($venue_id);
            $venue = venue::where(['venue_id'=>$id])->first();
            
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption error
            abort(403,"Some error occured");
        }

        if (is_null($venue))
        {
            return redirect()->route('venues.edit',$venue_id)->with('error', 'Invalid Id');

        }

        //Check whether the Venue is same or not

        $check=Venue::where('venue_id','!=',$id)
        ->where(strtolower('venue_name'),strtolower($request->venue_name))
        ->where(strtolower('venue_address'),strtolower($request->venue_address))->first();

        if($check)
        {   
          return redirect()->back()->with(['error'=>'This venue already added']);
        }

        DB::beginTransaction();
        try{


            $validatedData['updated_at']=Carbon::now();

            Venue::where(['venue_id'=>$id])->update($validatedData);
            DB::commit();

            return redirect()->route('venues.index')->with('success', 'venue updated successfully.');

        }
        catch(Exception $e)
        {
            DB::rollBack();
            return redirect()->route('venues.edit',$venue_id)->with('error', 'Some error occoured');

        }
     
    }

    public function destroy(Request $request,$venue_id)
    {
        try {
            $id = decrypt($venue_id);
            Venue::where(['venue_id'=>$id])->delete();

            return redirect()->back()->with(['success'=>'Successfully deleted']);
            
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption error
            return redirect()->back()->with(['error'=>'Some error occured']);
        }

    }

   


    //Server Side scripting

    public function venueQuery()
    {
        return Venue::query();
    }

    public function venueList(Request $request)
    {
        $column[0]=['venue_id','venue_name','venue_address','contact_number','is_active','created_at','updated_at','view'];
        $column[1]=['venues','venues','venues','venues','venues','venues','venues','ignore'];

        
        $d=new DatatableScripting();

        $parentQuery=$d->parentQuery($request,$column,$this->venueQuery($request));
        $dataQuery=$d->ServerSideScripting($column,$this->venueQuery($request),$request);

       

        $data=array();

        foreach($dataQuery->get() as $item) 
        {
            $sub_data = array();
            $sub_data['venue_id']=$item->venue_id??'-';
            $sub_data['venue_name']=ucfirst(strtolower($item->venue_name))??'-';
            $sub_data['venue_address']=$item->venue_address??'-';
            $sub_data['contact_number']=$item->contact_number??'-';

            $sub_data['is_active']=$item->is_active?'<span class="badge bg-success">Active</span>':'<span class="badge bg-danger">Inactive</span>';
            $sub_data['created_at']=$item->created_at?$item->created_at->format('d/m/Y  h:m A'):'';
        
            $script="$('#delete_modal').modal('show');$('#delete_form').attr('action','/genres/delete/".encrypt($item->genre_id)."')";

            $sub_data['view']='<a  href="/venues/edit/'.encrypt($item->venue_id).'" class="btn btn-sm btn-gray btn-icon mr-2" title="View details">Edit </a>
            <a   class="btn btn-sm btn-danger btn-icon mr-2" title="View details" onclick="'.$script.'">Delete </a>'
                     ;
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

