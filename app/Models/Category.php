<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Contracts\Translation\TranslatableInterface;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model
{
    use Translatable;
    protected $guarded=[];
    public $translatedAttributes = ['name'];

    public function products(){
        return $this->hasMany(product::class);
    }
}
