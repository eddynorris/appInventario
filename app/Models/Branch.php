<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country',
        'department',
        'province',
        'city',
        'address',
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function transfersTo()
    {
        return $this->hasMany(Transfer::class, 'to_branch_id');
    }

    public function inventory()
    {
        return $this->hasMany(BranchInventory::class);
    }
}
