<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use App\Enums\WorkOrderPriorityEnum;

class WorkOrderLineItem extends Model implements Auditable
{
    use AuditableTrait, HasFactory;

    protected $fillable = ['purchase_order_id', 'contractor_id', 'status', 'channel_id', 'priority'];

    protected $casts = [
        'priority' => WorkOrderPriorityEnum::class, // Cast the priority to the enum
    ];

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
}
