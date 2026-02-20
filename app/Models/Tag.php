<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Relationships
     * Many to Many
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
