<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    protected $table = 'pengunjung';

    protected $fillable = ['ip_address', 'waktu_kunjungan'];
}
