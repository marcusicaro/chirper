<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\MassPrunable;
use App\Models\Scopes\AncientScope;

class Flight extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;
    // use Prunable;
    use MassPrunable;

    protected $fillable = ['delayed', 'name', 'destination_id', 'arrived_at', 'destination', 'departure', 'price', 'discount'];

    protected $attributes = [
        'options' => '[]',
        'delayed' => false,
        'destination_id' => 1,
    ];

    protected $casts = [
        'options' => 'array',
    ];
    

    public function store(Request $request): RedirectResponse
    { 
        $flight = new Flight;
 
        $flight->name = $request->name;
        $flight->delayed = $request->delayed;
        $flight->destination_id = $request->destination_id;
        $flight->arrived_at = $request->arrived_at;
 
        $flight->save();
 
        return redirect('/flights');
    }

    public function prunable(): Builder
    {
        return static::where('created_at', '<=', now());
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new AncientScope);
    }
    public function scopeCheap(Builder $query): void
    {
        $query->where('price', '<=', 100);
    }
}
