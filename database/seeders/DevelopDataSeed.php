<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DevelopDataSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV') == 'local') {
            for ($i = 0; $i < 3; $i++) {
                Warehouse::create([
                    'name' => Str::random(4),
                    'code' => Str::random(8),
                ]);
            }

            for ($i = 0; $i < 20; $i++) {
                /** @var Item $item */
                $item = Item::create([
                    'name' => Str::random(4),
                    'price' => rand(1, 100),
                ]);

                /** @var Warehouse $warehouse */
                $warehouse = Warehouse::inRandomOrder()->first();
                $warehouse->items()->attach($item, ['count' => rand(1, 30)]);

            }

        }
    }
}
