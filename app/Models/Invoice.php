<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Invoice extends Model
{

    use HasFactory;
    protected $fillable = [
        'user_id',
        'cart',
        'invoice_number',
        'address',
        'postcode',
    ];
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasOne(Item::class);
    }
}

