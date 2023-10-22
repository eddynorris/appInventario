<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_type',
        'from_id',
        'branch_id',
        'product_id',
        'quantity',
        'user_id',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    
    public function fromBranch()
    {
        return $this->belongsTo(Branch::class, 'from_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
