<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;
    protected $table = 'events';

    public $timestamps = true;

    protected $fillable = ['title','genre_id','image','short_description','amount','date','venue_id','artist_id','is_active'];
    
    public function artist()
    {
        return $this->belongsTo(Artist::class,'artist_id','artist_id');
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class,'venue_id','venue_id');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class,'genre_id','genre_id');
    }
}
