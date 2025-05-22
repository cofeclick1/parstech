<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'service_code',
        'service_info',
        'service_category_id',
        'price',
        'unit_id',
        'unit',
        'short_description',
        'description',
        'info_link',
        'full_description',
        'image',
        'is_active',
    ];

    public function createOrUpdateProduct()
    {
        \App\Models\Product::updateOrCreate(
            ['code' => $this->service_code],
            [
                'name'        => $this->title,
                'code'        => $this->service_code,
                'category_id' => $this->service_category_id,
                'image'       => $this->image,
                'short_desc'  => $this->short_description,
                'description' => $this->description,
                'unit'        => $this->unit,
                'sell_price'  => $this->price,
                'type'        => 'service',
                'is_active'   => $this->is_active,
            ]
        );
    }
}
