<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    protected $appends = ['image_url'];

    public function destinations()
    {
        return $this->belongsToMany(Destination::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->icon
            ? Storage::url($this->icon)
            : asset('images/default-category.jpg');
    }
}
