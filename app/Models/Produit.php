<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = ['name', 'description', 'price','qte', 'photo', 'category_id'];
    public function category()
    {
      
        return $this->belongsTo(Category::class);
    }

    public function lignecommande()
    {
      
        return $this->hasMany(LigneCommande::class,'product_id','id');
    }
    // Query scope to filter products by category ID
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopePriceRange($query, $minPrice, $maxPrice)
    {
        return $query->whereBetween('price', [$minPrice, $maxPrice]);
    }
}
