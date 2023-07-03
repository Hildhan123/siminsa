<?php

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
        $this->call(UserSeeder::class);
        $this->call(DesaSeeder::class);
        $this->call(JenisAnggaranSeeder::class);
        $this->call(KelompokJenisAnggaranSeeder::class);
        $this->call(DetailJenisAnggaranSeeder::class);
        $this->call(modulSeeder::class);
    }
}
