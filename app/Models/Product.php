<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function favorite(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function scopeRecommendedProducts($query, $userId, $count = 3)
    {
        $favoriteProducts = Favorite::where('user', $userId)->pluck('product');

        if ($favoriteProducts->count() > 0) {

            $favoriteProductsQuery = Product::whereIn('id', $favoriteProducts)->get();
            $randomProducts = Product::whereNotIn('id', $favoriteProducts)->inRandomOrder()->take($count - $favoriteProducts->count())->get();

            return $favoriteProductsQuery->merge($randomProducts)->unique('id')->take($count);
        } else {

            return Product::inRandomOrder()->take($count)->get();
        }
    }


}
