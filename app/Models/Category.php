<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'category_id';
    protected $fillable = ['category_name'];

    
}
