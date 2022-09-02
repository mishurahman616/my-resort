<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    /* Defining the table name, primary key, incrementing, key type, and timestamps. */
    public $table='admins';
    public $primaryKey='id';
    public $incrementing='true';
    public $keyType='int';
    public $timestamps='true'; 
}
