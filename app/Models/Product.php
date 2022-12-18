<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Sluggable;
    // De primaire sleutel die aan de tabel is gekoppeld.
    protected $primaryKey = 'slug';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'slug',
        'shortdescription',
        'fulldescription',
        'discount',
        'price',
        'weight',
        'image',
        'sub_category_slug',
    ];
    // Een op veel (omgekeerd)
    public function subcategories() {
        return $this->belongsTo(SubCategory::class);
    }
    // Zoekfunctie
    public function scopeFilter($query, array $filters) {
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('shortdescription', 'like', '%' . $search . '%'));
    }

    // Een functie voor het bepalen van de discountprijs met behulp van een accessor
    public function getDiscountedPriceAttribute()
    {
        return $this->price * (1 - $this->discount / 100);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
