<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResortImages extends Model
{
    use HasFactory;
            /* Defining the table name, primary key, incrementing, key type, and timestamps. */
            public $table='resort_images';
            public $primaryKey='id';
            public $incrementing='true';
            public $keyType='int';
            public $timestamps='true'; 
            protected $fillable = ['link', 'resort_id'];

            function resort(){
                return $this->belongsTo(Resort::class);
            }

}
