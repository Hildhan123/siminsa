<?php

use Illuminate\Database\Seeder;

class testPagination extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 20; $i++){
            DB::table('potensis')->insert([    
                'user_id' => 1,
                'nama' => 'Test Pagination',
                'konten' => '<p>sdfsdf</p>',
                'created_at' => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ]);
            }
    }
}
