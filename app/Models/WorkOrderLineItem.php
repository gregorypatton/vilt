<?php

namespace App\Models;

use APP\Traits\Filterable;
// use App\Traits\Sluggable;
// use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class WorkOrderLineItem extends Model implements Auditable
{
    use AuditableTrait, HasFactory, Filterable;

    protected $fillable = ['purchase_order_id', 'contractor_id', 'status', 'channel_id'];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function contractor()
    {
        return $this->belongsTo(Contractor::class);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function lineItems()
    {
        return $this->hasMany(WorkOrderLineItem::class);
    }

    protected $casts = [
        //
    ];

    protected $translatable = [
        //
    ];
}
