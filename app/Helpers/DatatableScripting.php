<?php

namespace App\Helpers;

class DatatableScripting
{

    public function  ServerSideScripting($column,$query,$request)
    {
        
        if ($request->order) 
        {
            if ($column[1][$request->order[0]['column']] === 'ignore') {

            }
            else   
            {
                $query = $query->orderby( $column[1][$request->order[0]['column']].'.'.$column[0][$request->order[0]['column']], $request->order[0]['dir']);
            }
        }
        else
        {
            $query = $query->orderby( $column[1][0].'.'.$column[0][0], 'desc');
        }

        if ($request->search ? $request->search['value'] : false) 
        {
           

            $query=$query->where(function ($query) use($column,$request) {
                foreach($column[0] as $key=>$value)
                {
                    if ($column[1][$key] === 'ignore') {

                    }
                    else{
                        $query->orWhere($column[1][$key].'.'.$column[0][$key], 'like', '%' . $request->search['value'] . '%');
                    }
                }
           });
          
        }

        if ( $request->length != -1)
        {
            $query = $query->take($request->length??10)->skip($request->start??0);
        }

        return $query;

    }



    public function parentQuery($request,$column,$q)
    {

    
        if ($request->search ? $request->search['value'] : false) {

            $q=$q->where(function ($a) use($column,$request) {

                foreach ($column[0] as $key => $value) {
                    if ($column[1][$key] === 'ignore') 
                    {

                    } 
                    
                    else {
    
                        $a->orWhere($column[1][$key] . '.' . $column[0][$key], 'like', '%' . $request->search['value'] . '%');
                    }
                }
            });
            
        }
        
        return $q; 
    }


}