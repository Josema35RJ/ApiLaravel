<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use HasApiTokens;
	use HasFactory, Notifiable;
	protected $table = 'users';

	protected $casts = [
		'email_confirmed' => 'int',
		'email_verified_at' => 'datetime',
		'actived' => 'int',
		'code' => 'int',
		'deleted' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'email_confirmed',
		'email_verified_at',
		'actived',
		'type',
		'code',
		'password',
		'remember_token',
		'deleted'
	];
}
