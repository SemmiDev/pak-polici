<?php

namespace App\Models;

use App\Models\Base\Absensi as BaseAbsensi;

class Absensi extends BaseAbsensi
{
	protected $fillable = [
		'id_user',
		'tanggal',
		'waktu',
		'lokasi',
		'latitude',
		'longitude',
		'foto',
		'status',
		'keterangan'
	];
}
