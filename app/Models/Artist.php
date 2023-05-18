<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;
    protected $table = 'artists';

    public $timestamps = true;

    protected $fillable = ['artist_name', 'is_active'];

}
