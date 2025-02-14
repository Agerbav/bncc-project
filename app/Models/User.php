<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    
    protected $fillable = [
        "name",
        "email",
        "phone",
        "password",
        "role_id",
    ];
    
    public function role()
    {
        return $this->belongsTo(Role::class, "role_id", "id");
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
