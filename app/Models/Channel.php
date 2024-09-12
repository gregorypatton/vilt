<?php

namespace App\Models;

use APP\Traits\Filterable;
// use App\Traits\Sluggable;
// use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;
    use Filterable;
    // use Sluggable;
    // use Translatable;

    protected $fillable = [
        'name'
    ];

    protected $casts = [
        //
    ];

    protected $translatable = [
        //
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('channel_identifier');
    }
}
