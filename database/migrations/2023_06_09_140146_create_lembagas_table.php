<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLembagasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lembagas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('logo')->nullable();
            $table->string('nama');
            $table->string('singkatan')->nullable();;
            $table->string('dasar_hukum');
            $table->string('alamat');
            $table->longText('profil')->nullable();
            $table->longText('visi_misi')->nullable();
            $table->longText('tugas_dan_fungsi')->nullable();
            $table->longText('kepengurusan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lembagas');
    }
}
