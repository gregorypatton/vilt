<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Seller extends Model implements Auditable
{
    use HasFactory, Filterable, AuditableTrait;

    protected $fillable = ['name', 'subscription_status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function parts()
    {
        return $this->hasMany(Part::class);
    }

    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function workOrders()
    {
        return $this->hasMany(WorkOrder::class);
    }

    public function prepLabors()
    {
        return $this->hasMany(PrepLabor::class);
    }

    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }

    protected $casts = [
        //
    ];

    protected $translatable = [
        //
    ];
}
