<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'image',
        'status',
        'category_id',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }
}
