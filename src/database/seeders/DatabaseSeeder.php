<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 先に季節データを作成
        $this->call(SeasonSeeder::class);

        // 商品データと季節の紐付けを作成
        $this->call(ProductSeeder::class);
    }
}
