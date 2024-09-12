<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles; // HasRoles from spatie handles role management

    protected $fillable = [
        'name',
        'email',
        'password',
        'administrator' // Assuming this is for flagging super admin or similar
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relationships
     */
    public function sellerProfile()
    {
        return $this->hasOne(Seller::class);
    }

    public function contractorProfile()
    {
        return $this->hasOne(Contractor::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function parts()
    {
        return $this->hasMany(Part::class);
    }

    public function workOrders()
    {
        return $this->hasMany(WorkOrder::class);
    }
}
