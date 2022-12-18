<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Discount;
use App\Models\NewsMessage;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function main()
    {
        // Afgeprijsde items
        $discounts = Product::where('discount', '>', 0)->inRandomOrder()->take(3)->get();
        // Het laatste nieuws
        $news = NewsMessage::all()->last();
        $sale = Discount::all()->last();
        // Het laatste aanbieding
        return view('index', compact('discounts', 'news', 'sale'));
    }

    public function category() {
        // Alle categorieën
        $categories = Category::all();
        return view('pages.category', compact('categories'));
    }

    public function subcategory($slug) {
        // Geselecteerde categorie
        $category = Category::where('slug', $slug)->firstOrFail();
        // Subcategorieën van de geselecteerde categorie
        $subcategories = SubCategory::with('products_rel')->where('category_slug', $category->slug)->get();
        return view('pages.subcategory', compact( 'category', 'subcategories'));
    }

    public function product($category_slug) {
        // Geselecteerde product
        $product = Product::where('slug', $category_slug)->firstOrFail();
        // Subcategorieën van de geselecteerde product
        $subcategories = SubCategory::where('slug', $product->sub_category_slug)->get();
        // Loop om elke subcategorie van zijn categorie te krijgen
        foreach ($subcategories as $subcategory) {
        $categories = Category::where('slug', $subcategory->category_slug)->get();
        }
        return view('pages.product', compact('product', 'categories'));
    }

    public function discount() {
        // Zo ja, ontvang dan afgeprijsde artikelen
        $discounts = Product::where('discount', '>', 0)->get();
        return view('pages.discount', compact('discounts'));
    }

    // Product zoeken met behulp van de functie scopeFilter() (model:Product.php)
    public function search() {
        $products = Product::latest()->get();
        $search = Product::latest()->filter(request(['search']))->get();
        return view('pages.search', compact('products', 'search'));
    }
}