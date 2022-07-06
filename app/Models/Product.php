<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    static function customCreate($title, $genre, $developer, $price, $image = null){
        return Product::create([
            'title' => $title,
            'genre' => $genre,
            'developer' => $developer,
            'price' => $price,
            'slug' => Product::generateSlug($title),
            'image' => $image
        ]);
    }

    // static function customUpdate($id, $title, $genre, $developer, $price){
    //     return Product::where('id', $id)->update([
    //         'title' => $title,
    //         'genre' => $genre,
    //         'developer' => $developer,
    //         'price' => $price,
    //         'slug' => Product::generateSlug($title)
    //     ]);
    // }

    static function customUpdate($id, $array){
        return Product::where('id', $id)->update([
            'title' => $array['title'],
            'genre' => $array['genre'],
            'developer' => $array['developer'],
            'price' => $array['price'],
            'slug' => Product::generateSlug($array['title']),
            'image' => isset($array['image']) ? $array['image'] : null 
            // 'image' => isset($array['image']) ? $array['image'] : null
        ]);
    }

    static function generateSlug($title){
        $slug = $title;
        $slug = strtolower($slug);
        $slug = str_replace(' ', '-', $slug);
        
        return $slug;
    }

    public function getRouteKeyName(){
        return 'slug';
    }
}
