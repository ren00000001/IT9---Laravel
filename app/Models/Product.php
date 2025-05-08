<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_name',
        'category_id',
        'product_price',
        'product_status',
        'product_description',
    ];

    protected $casts = [
        'product_price' => 'decimal:2',
        'product_status' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function inventory(){
        return $this->hasOne(Inventory::class, 'product_id');
    }

    public function setProductQuantityAttribute($value){
        if($this->exists && $this->inventory){
            throw new \Exception("Product quantity must be updated through inventory table");
        }
        $this->attributes['product_quantity'] = $value;
    }

}

