<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'cas_code',
        'concentration',
        'concentration_type',
        'capacity',
        'expiration_date',
        'locker',
    ];

    public function cascode()
    {
        return $this->belongsTo(Cascode::class, 'cas_code', 'cas_code');
    }

    public function consumptions(): HasMany
    {
        return $this->hasMany(Consumption::class);
    }
}
