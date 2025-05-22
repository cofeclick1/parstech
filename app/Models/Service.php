<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'service_code',
        'service_category_id',
        'unit',
        'price',
        'tax',
        'execution_cost',
        'short_description',
        'description',
        'image',
        'is_active',
        'is_vat_included',
        'is_discountable',
    ];

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    /**
     * ساخت یا بروزرسانی محصول معادل برای این خدمت
     */
    public function createOrUpdateProduct()
    {
        // توجه کن اگر category_id شما متفاوت است، اینجا مقداردهی را عوض کن
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
