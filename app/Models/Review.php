<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id',
        'user_id',
        'rating',
        'comment',
        'is_verified'
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'rating' => 'integer'
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
