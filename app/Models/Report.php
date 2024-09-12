<?php

namespace App\Models;

use App\Traits\Filterable;
// use App\Traits\Sluggable;
// use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Report extends Model implements Auditable
{
    use HasFactory, Filterable, AuditableTrait;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'status',
        'generated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
