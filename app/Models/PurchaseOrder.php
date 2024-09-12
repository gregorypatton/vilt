<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class PurchaseOrder extends Model implements Auditable
{
    use AuditableTrait, HasFactory, Filterable;

    protected $fillable = ['po_number', 'supplier_id', 'total_amount', 'status', 'seller_id'];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function parts()
    {
        return $this->hasMany(PurchaseOrderPart::class);
    }

    public function workOrders()
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
