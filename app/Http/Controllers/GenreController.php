<?php

namespace App\Http\Controllers;

use App\Helpers\DatatableScripting;
use Illuminate\Http\Request;
use App\Models\Genre;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('genre.index', compact('genres'));
    }

    public function create()
    {
        return view('genre.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'genre_name' => 'required',
            'is_active' => 'boolean',
        ]);

        $check=Genre::where(strtolower('genre_name'),strtolower($request->genre_name))->first();

        if($check)
        {   
          throw ValidationException::withMessages(['genre_name'=>"This Genre already present"]);
        }

        DB::beginTransaction();
        try{

            Genre::create($validatedData);
            DB::commit();
            return redirect()->route('genres.index')->with('success', 'Genre created successfully.');

        }
        catch(Exception $e)
        {
            DB::rollBack();
            return redirect()->route('genres.index')->with('error', 'Some error occoured');

        }

    
    }

    public function edit($genre_id,Request $request)
    {

        try {
            $id = decrypt($genre_id);
            $genre = Genre::where(['genre_id'=>$id])->first();
            
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption error
            abort(404);
        }

        return view('genre.create', compact('genre'));
    }

    public function update(Request $request,$genre_id)
    {
        $validatedData = $request->validate([
            'genre_name' => 'required',
            'is_active' => 'boolean',
        ]);

     
        try {
            $id = decrypt($genre_id);
            $genre = Genre::where(['genre_id'=>$id])->first();
            
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption error
            abort(403,"Some error occured");
        }

        if (is_null($genre))
        {
            return redirect()->route('genres.edit',$genre_id)->with('error', 'Invalid Id');

        }

        //Check whether the genre is same or not

        $check=Genre::where('genre_id','!=',$id)->where(['genre_name'=>strtolower($request->genre_name)])->where('genre_id','!=',$id)->first();

        if($check)
        {   
          throw ValidationException::withMessages(['genre_name'=>"This genre already present"]);
        }

        DB::beginTransaction();
        try{


            $validatedData['genre_name']=strtolower($request->genre_name??'');
            $validatedData['updated_at']=Carbon::now();

            Genre::where(['genre_id'=>$id])->update($validatedData);
            DB::commit();

            return redirect()->route('genres.index')->with('success', 'Genre updated successfully.');

        }
        catch(Exception $e)
        {
            DB::rollBack();
            return redirect()->route('genres.edit',$genre_id)->with('error', 'Some error occoured');

        }
     
    }

    public function destroy(Request $request,$genre_id)
    {
        try {
            $id = decrypt($genre_id);
            Genre::where(['genre_id'=>$id])->delete();

            return redirect()->back()->with(['success'=>'Successfully deleted']);
            
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Handle decryption error
            return redirect()->back()->with(['error'=>'Some error occured']);
        }

    }



    //Server Side scripting

    public function genreQuery()
    {
        return Genre::query();
    }

    public function genreList(Request $request)
    {
        $column[0]=['genre_id','genre_name','is_active','created_at','updated_at','view'];
        $column[1]=['genres','genres','genres','genres','genres','ignore'];

        
        $d=new DatatableScripting();

        $parentQuery=$d->parentQuery($request,$column,$this->genreQuery($request));
        $dataQuery=$d->ServerSideScripting($column,$this->genreQuery($request),$request);

       

        $data=array();

        foreach($dataQuery->get() as $item) 
        {
            $sub_data = array();
            $sub_data['genre_id']=$item->genre_id??'-';
            $sub_data['genre_name']=ucfirst(strtolower($item->genre_name??''))??'-';
            $sub_data['is_active']=$item->is_active?'<span class="badge bg-success">Active</span>':'<span class="badge bg-danger">Inactive</span>';
            $sub_data['created_at']=$item->created_at?$item->created_at->format('d/m/Y  h:m A'):'';
           

            $script="$('#delete_modal').modal('show');$('#delete_form').attr('action','/genres/delete/".encrypt($item->genre_id)."')";

            $sub_data['view']='<a  href="/genres/edit/'.encrypt($item->genre_id).'" class="btn btn-sm btn-gray btn-icon mr-2" title="View details"> Edit </a>
            '
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
