<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use HasFactory, Filterable, SoftDeletes;

    protected $table = 'warehouses';
    protected $guarded = [];
    protected $hidden = ['deleted_at'];
    protected $casts = [
        'options' => 'array',
    ];
    public $timestamps = false;

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(
            Item::class,
            'warehouse_item',
            'warehouse_id',
            'item_id'
        )->withPivot('count');
    }

    public function getItemCount(int $itemId): int
    {
        $item = $this->items()->where('item_id', $itemId)->first();
        return $item?->pivot?->count ?? 0;
    }

}
