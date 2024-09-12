<?php

namespace App\Models;

use APP\Traits\Filterable;
// use App\Traits\Sluggable;
// use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory, Filterable;

    protected $fillable = ['part_id', 'location_id', 'quantity', 'last_change_user', 'last_change_ts', 'seller_id'];

    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

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
