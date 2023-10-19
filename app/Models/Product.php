<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'units',
        'measures',
        'price',
    ];

    public function salesDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }

    public function inventory()
    {
        return $this->hasMany(BranchInventory::class);
    }
}
