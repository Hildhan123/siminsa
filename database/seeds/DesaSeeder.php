<?php

use App\Desa;
use Illuminate\Database\Seeder;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Desa::create([
            'user_id'           => '1',
            'nama_kelurahan'    => 'Bintoro',
            'nama_kecamatan'    => 'Demak',
            'nama_kabupaten'    => 'Demak',
            'alamat'            => 'Bintoro',
            'logo'              => "logo.png",
        ]);
    }
}
