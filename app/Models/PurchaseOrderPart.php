<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderPart extends Model
{
    use HasFactory, Filterable;

    protected $fillable = ['purchase_order_id', 'part_id', 'quantity', 'cost'];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    public function workOrder()
    {
        return $this->belongsToMany(WorkOrder::class)->withPivot('quantity_allocated');
    }

    protected $casts = [
        //
    ];

    protected $translatable = [
        //
    ];
}
