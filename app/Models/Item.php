<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    // Optionally specify the table name if different from the default plural form
    // protected $table = 'items'; // Optional, not needed if your table follows Laravel's conventions

    // Optionally specify the column names for timestamps if different
    // const CREATED_AT = 'createdAt';
    // const UPDATED_AT = 'updatedAt';
}
