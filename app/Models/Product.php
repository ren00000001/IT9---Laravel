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
        'product_quantity',
        'product_status',
        'product_description',
        'product_image',
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

    public function getProductStatusAttribute(){
        return $this->product_quantity > 0 ? 'In-Stock' : 'Out-of-Stock';    
    }

    protected static function booted(){
        static::saving(function ($product) {
            $product->product_status = $product->product_quantity > 0;
        });
    }

    public function getImageAttribute(){
        if ($this->product_image){
            return asset('storage/' . $this->product_image);
        }
        return null;
    }

}

