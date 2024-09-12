<?php

namespace App\Models;

use APP\Traits\Filterable;
// use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Product extends Model implements Auditable
{

    use HasFactory, Filterable, AuditableTrait;

    protected $fillable = ['name', 'description', 'price', 'seller_id'];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function productParts()
    {
        return $this->hasMany(ProductPart::class);
    }

    public function workOrders()
    {
        return $this->hasMany(WorkOrder::class);
    }

    public function channels()
    {
        return $this->belongsToMany(Channel::class)->withPivot('channel_identifier');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    protected $casts = [
        //
    ];

    protected $translatable = [
        //
    ];
}
