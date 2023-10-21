<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'ruc',
        'address',
        'phone',
        'email',
    ];

    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
