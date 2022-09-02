<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resort extends Model
{
    use HasFactory;
        /* Defining the table name, primary key, incrementing, key type, and timestamps. */
        public $table='resorts';
        public $primaryKey='id';
        public $incrementing='true';
        public $keyType='int';
        public $timestamps='true'; 
        protected $fillable = ['type', 'desc', 'room', 'price'];

        function images(){
            return $this->hasMany(ResortImages::class);
        }
}
