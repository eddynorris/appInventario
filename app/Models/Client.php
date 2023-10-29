<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'name',
        'document',
        'address',
        'phone',
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
