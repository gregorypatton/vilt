<?php

namespace App\Models;

use APP\Traits\Filterable;
// use App\Traits\Sluggable;
// use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Settlement extends Model implements Auditable
{
    use HasFactory, Filterable, AuditableTrait;

    protected $fillable = [
        'seller_id',
        'amount',
        'status'
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    protected $casts = [
        //
    ];

    protected $translatable = [
        //
    ];
}
