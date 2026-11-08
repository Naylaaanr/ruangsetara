<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Place extends Model
{
    public const STATUS_BELUM = 'belum_diverifikasi';
    public const STATUS_SUDAH = 'sudah_diverifikasi';
    public const STATUS_PERIKSA = 'perlu_diperiksa';

    protected $fillable = [
        'category_id',
        'name',
        'address',
        'district',
        'description',
        'phone',
        'opening_hours',
        'maps_url',
        'status',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class);
    }
}
