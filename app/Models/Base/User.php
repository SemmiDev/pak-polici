<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $nip
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Absensi[] $absensis
 *
 * @package App\Models\Base
 */
class User extends Model
{
	protected $table = 'users';

	public function absensis()
	{
		return $this->hasMany(Absensi::class, 'id_user');
	}
}
