<?php

namespace App\Models;

use APP\Traits\Filterable;
// use App\Traits\Sluggable;
// use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartLocation extends Model
{
    use HasFactory;
    use Filterable;
    // use Sluggable;
    // use Translatable;

    protected $fillable = [
        //
    ];

    protected $casts = [
        //
    ];

    protected $translatable = [
        //
    ];
}
