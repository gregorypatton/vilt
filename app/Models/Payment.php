<?php

namespace App\Models;

use APP\Traits\Filterable;
// use App\Traits\Sluggable;
// use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    use Filterable;

    protected $fillable = ['seller_id', 'user_id', 'amount', 'payment_type', 'payment_date'];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invoices()
    {
        return $this->hasMany(PaymentInvoice::class);
    }


}
