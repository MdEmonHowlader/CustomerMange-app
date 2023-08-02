<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'image'];
    public function product(): HasMany {
        return $this->hasMany( Product::class );
    }
}
