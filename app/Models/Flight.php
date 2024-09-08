<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Flight extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = ['title', 'delayed', 'name', 'destination_id', 'arrived_at'];

    protected $attributes = [
        'options' => '[]',
        'delayed' => false,
    ];

    protected $casts = [
        'options' => 'array',
    ];
}
