<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class WorkOrder extends Model implements Auditable
{
    use AuditableTrait, HasFactory, Filterable;

    protected $fillable = ['contractor_id', 'status', 'channel_id'];

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

    public function purchaseOrders()
    {
        return $this->belongsToMany(PurchaseOrder::class)->withPivot('quantity_allocated');
    }

    public function totalSignedOff()
    {
        return $this->lineItems()->withSum('contractorSignoffs', 'quantity_signed_off')->get()->sum('contractor_signoffs_sum_quantity_signed_off');
    }

    protected $casts = [
        //
    ];

    protected $translatable = [
        //
    ];
}
