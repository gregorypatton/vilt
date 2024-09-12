<?php

namespace App\Models;

use APP\Traits\Filterable;
// use App\Traits\Sluggable;
// use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory, Filterable;

    protected $fillable = ['name', 'description', 'stock_quantity', 'supplier_id', 'seller_id'];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function productParts()
    {
        return $this->hasMany(ProductPart::class);
    }

    public function inventories()
    {
        return $this->hasMany(PartInventory::class);
    }

    public function purchaseOrderParts()
    {
        return $this->hasMany(PurchaseOrderPart::class);
    }

    protected $casts = [
        //
    ];

    protected $translatable = [
        //
    ];
}
