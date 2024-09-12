<?php

namespace App\Models;

use APP\Traits\Filterable;
// use App\Traits\Sluggable;
// use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrepLabor extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'work_order_id',
        'hours_spent',
        'worker_name'
    ];

    public function workOrder()
    {
        return $this->belongsTo(WorkOrder::class);
    }

    protected $casts = [
        //
    ];

    protected $translatable = [
        //
    ];
}
