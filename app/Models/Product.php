<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', 'name', 'detail', 'image', 'price'
    ];

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class)->with('attributes');
    }
}
