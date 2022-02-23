<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class product extends Model
{
    use HasFactory;
    use Translatable;
    protected $guarded=[];
    public $translatedAttributes = ['name','description'];
    protected $appends = ['image_Path','profit_percent'];

    public function category(){
        return $this->belongsTo(category::class);
    }

    public function getprofitAttribute(){
        $profit = $this->sale_price - $this->purchase_price;
        return $profit;
    }

    public function getprofitpercentAttribute(){
        $profit = $this->sale_price - $this->purchase_price;
        $profit_Percent = $profit * 100 / $this->purchase_price;
        return number_format($profit_Percent,1);
    }
    public function getImagePathAttribute(){
        return asset('uploads/product_images/'. $this->image);
    }

    public function order(){
        return $this->belongsToMany(order::class,'product_order');
    }



}
