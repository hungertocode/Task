<?php

namespace App\Http\Controllers;

use App\Helpers\DatatableScripting;
use Illuminate\Http\Request;
use App\Models\Artist;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::all();

        // return $artists;
        return view('artist.index', compact('artists'));
    }

    public function create()
    {
        return view('artist.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'artist_name' => 'required',
            'is_active' => 'boolean',
        ]);

        $check=Artist::where(strtolower('artist_name'),strtolower($request->artist_name))->first();

        if($check)
        {   
          throw ValidationException::withMessages(['artist_name'=>"This Artist already present"]);
        }

        DB::beginTransaction();
        try{

            Artist::create($validatedData);
            DB::commit();
            return redirect()->route('artists.index')->with('success', 'Artist created successfully.');

        }
        catch(Exception $e)
        {
            DB::rollBack();
            return redirect()->route('artists.index')->with('error', 'Some error occoured');

        }

    
    }

    public function edit(Request $request,$artist_id)
    {

        try {
            $id = decrypt($artist_id);
            $artist = Artist::where(['artist_id'=>$id])->first();
            
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption error
            abort(404);
        }

        return view('artist.create', compact('artist'));
    }

    public function update(Request $request,$artist_id)
    {
        $validatedData = $request->validate([
            'artist_name' => 'required',
            'is_active' => 'boolean',
        ]);

     
        try {
            $id = decrypt($artist_id);
            $artist = Artist::where(['artist_id'=>$id])->first();
            
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption error
            abort(403,"Some error occured");
        }

        if (is_null($artist))
        {
            return redirect()->route('artists.edit',$artist_id)->with('error', 'Invalid Id');

        }

        //Check whether the genre is same or not

        $check=Artist::where('artist_id','!=',$id)->where(['artist_name'=>strtolower($request->artist_name)])->first();

        if($check)
        {   
          throw ValidationException::withMessages(['artist_name'=>"This Artist already present"]);
        }

        DB::beginTransaction();
        try{


            $validatedData['artist_name']=strtolower($request->artist_name??'');
            $validatedData['updated_at']=Carbon::now();

            Artist::where(['artist_id'=>$id])->update($validatedData);
            DB::commit();

            return redirect()->route('artists.index')->with('success', 'artist updated successfully.');

        }
        catch(Exception $e)
        {
            DB::rollBack();
            return redirect()->route('artists.edit',$artist_id)->with('error', 'Some error occoured');

        }
     
    }

    public function destroy(Request $request,$artist_id)
    {
        try {
            $id = decrypt($artist_id);
            Artist::where(['artist_id'=>$id])->delete();

            return redirect()->back()->with(['success'=>'Successfully deleted']);
            
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption error
            return redirect()->back()->with(['error'=>'Some error occured']);
        }

    }

   


    //Server Side scripting

    public function artistQuery()
    {
        return Artist::query();
    }

    public function artistList(Request $request)
    {
        $column[0]=['artist_id','artist_name','is_active','created_at','updated_at','view'];
        $column[1]=['artists','artists','artists','artists','artists','ignore'];

        
        $d=new DatatableScripting();

        $parentQuery=$d->parentQuery($request,$column,$this->artistQuery($request));
        $dataQuery=$d->ServerSideScripting($column,$this->artistQuery($request),$request);

       

        $data=array();

        foreach($dataQuery->get() as $item) 
        {
            $sub_data = array();
            $sub_data['artist_id']=$item->artist_id??'-';
            $sub_data['artist_name']=ucfirst(strtolower($item->artist_name))??'-';
            $sub_data['is_active']=$item->is_active?'<span class="badge bg-success">Active</span>':'<span class="badge bg-danger">Inactive</span>';
            $sub_data['created_at']=$item->created_at?$item->created_at->format('d/m/Y  h:m A'):'';
        
            $script="$('#delete_modal').modal('show');$('#delete_form').attr('action','/artists/delete/".encrypt($item->artist_id)."')";

            $sub_data['view']='<a  href="/artists/edit/'.encrypt($item->artist_id).'" class="btn btn-sm btn-gray btn-icon mr-2" title="View details">Edit </a>
            ' ;

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

