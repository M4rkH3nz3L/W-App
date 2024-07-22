<?php

namespace Modules\Shop\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'views',
        'language_id',
        'content_id',
        'type',
        'name',
        'description',
        'media_id',
        'media_group_id',
        'rental_duration',
        'rental_price',
        'sale_price',
        'sale_quantity'
    ];
    public function getRentalCostAttribute()
    {
        if ($this->type === 'Rent' && $this->rental_duration && $this->rental_price) {
            return $this->rental_duration * $this->rental_price;
        }
        return null;
    }
    public function getSaleCostAttribute()
    {
        if ($this->type === 'Buy' && $this->sale_quantity && $this->sale_price) {
            return $this->sale_quantity * $this->sale_price;
        }
        return null;
    }

}
