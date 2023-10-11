<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Absensi
 * 
 * @property int $id
 * @property int $id_user
 * @property Carbon $tanggal
 * @property Carbon $waktu
 * @property string $lokasi
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string $foto
 * @property string $status
 * @property string|null $keterangan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models\Base
 */
class Absensi extends Model
{
	protected $table = 'absensi';

	protected $casts = [
		'id_user' => 'int',
		'tanggal' => 'datetime',
		'waktu' => 'datetime'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}
}
