<?php

use Illuminate\Database\Seeder;
//use DB;

class modulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama'=>'Organisasi', 'slug'=>'organisasi'],
            ['nama'=>'Perangkat', 'slug'=>'perangkat-kelurahan'],
            ['nama'=>'Lembaga', 'slug'=>'lembaga-kelurahan'],
            ['nama'=>'Layanan', 'slug'=>'layanan-kelurahan'],
            ['nama'=>'Pengumuman', 'slug'=>'pengumuman-kelurahan'],
            ['nama'=>'Agenda', 'slug'=>'agenda-kelurahan'],
            ['nama'=>'Download', 'slug'=>'download-kelurahan'],
            // ['nama'=>'Laporan APB', 'slug'=>'laporan-apbdes'],
            ['nama'=>'Galeri', 'slug'=>'gallery'],
            ['nama'=>'Produk', 'slug'=>'produk-kelurahan'],
            ['nama'=>'Berita', 'slug'=>'berita'],
            // ['nama'=>'Pages', 'slug'=>'p'],
            ['nama'=>'Potensi', 'slug'=>'potensi-kelurahan'],
        ];
        DB::table('moduls')->insert($data);
    }
}
