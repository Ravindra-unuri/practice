<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $casts = [
        'product_price' => 'integer',
    ];

    public function setProductNameAttribute($value)
    {
        $this->attributes['product_name'] = strtoupper($value);
    }

    public function getProductNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function orders()
    {
        return $this->belongsToMany(order::class);
    }

    protected $fillable = [
        'id',
        'product_name',
        'product_price',
    ];
}
