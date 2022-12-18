<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
  use Sluggable;
  // De primaire sleutel die aan de tabel is gekoppeld.
  protected $primaryKey = 'slug';
  public $incrementing = false;
  protected $keyType = 'string';

  protected $fillable = ['name', 'slug', 'category_slug'];

  // Een één-op-veel relatie
  public function products_rel() {
    return $this->hasMany(Product::class);
  }
  // Een op veel (omgekeerd)
  public function categories() {
    return $this->belongsTo(Category::class);
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
