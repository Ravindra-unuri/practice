<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(product::class);
    }

    protected $fillable = [
        'id',
        'order_name',
        'product_id',
        'customer_id',
        'price',
    ];
}
