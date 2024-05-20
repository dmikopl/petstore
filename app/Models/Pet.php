<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = ['id', 'category_id', 'name', 'photoUrls', 'tags', 'status'];
}
