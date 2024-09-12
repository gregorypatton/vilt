<?php

namespace App\Models;

use APP\Traits\Filterable;
// use App\Traits\Sluggable;
// use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Supplier extends Model implements Auditable
{
    use AuditableTrait, HasFactory, Filterable;

    protected $fillable = ['name', 'contact_info'];

    public function parts()
    {
        return $this->hasMany(Part::class);
    }

    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    protected $casts = [
        //
    ];

    protected $translatable = [
        //
    ];
}
