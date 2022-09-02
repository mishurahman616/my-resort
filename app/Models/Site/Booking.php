<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
            /* Defining the table name, primary key, incrementing, key type, and timestamps. */
            public $table='bookings';
            public $primaryKey='id';
            public $incrementing='true';
            public $keyType='int';
            public $timestamps='true'; 
}
