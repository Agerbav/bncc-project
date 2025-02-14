<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'price',
        'count',
        'image_path',
    ];

    public function invoices()
    {
        return $this->hasOne(Item::class);
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, "category_id", "id");
    }
}
