<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Facility extends Model
{
    protected $fillable = ['name', 'need'];

    public function places(): BelongsToMany
    {
        return $this->belongsToMany(Place::class);
    }
}
