<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cascode extends Model
{
    use HasFactory;

    protected $fillable = [
        'cas_code',
        'name',
        'fds',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'cas_code', 'cas_code');
    }
}
