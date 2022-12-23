<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    use HasFactory, Filterable;

    protected $table = 'items';
    protected $guarded = [];
    protected $with = ['warehouses'];
    protected $appends = ['total'];
    public $timestamps = false;

    public function warehouses(): BelongsToMany
    {
        return $this->belongsToMany(
            Warehouse::class,
            'warehouse_item',
            'item_id',
            'warehouse_id'
        )->withPivot('count');
    }

    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->warehouses()->sum('count'),
        );
    }

    public function toArray(): array
    {
        $arr = parent::toArray();
        foreach ($arr['warehouses'] as $index => $value) {
            $arr['warehouses'][$index]['count'] = $arr['warehouses'][$index]['pivot']['count'];
            unset($arr['warehouses'][$index]['pivot']);
        }
        return $arr;
    }
}
