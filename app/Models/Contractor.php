<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Contractor extends Model implements Auditable
{
    use HasFactory, Filterable, AuditableTrait;

    protected $fillable = ['user_id', 'pin_number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workOrders()
    {
        return $this->hasMany(WorkOrder::class);
    }

    public function signoffs()
    {
        return $this->hasMany(ContractorSignoff::class);
    }

    protected $casts = [
        //
    ];

    protected $translatable = [
        //
    ];
}
