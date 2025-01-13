<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    private static $_instance = null; 
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nickname',
        'login',
        'password',
        'path_icon'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'user_achievement', 'user_id', 'achievement_id')->withTimestamps();
    }

    public function selected() {
        return $this->hasMany(SelectedCurs::class, 'user_id', 'id');
    }

    public function makeAuth() {
		$_SESSION['user'] = "user";
		$_SESSION['id'] = $this->id;
		self::$_instance = $this;
	}

	public function logOut() {
		return self::logOutStatic();
	}

	static function logOutStatic() {
		$_SESSION['user'] = "off";
		$_SESSION['id'] = 0;
		self::$_instance = null;
	}

	static public function auth() {
		if (!isset($_SESSION['user']) or ($_SESSION['user'] != "user") ) {
			return null;
		}
		if (isset($_SESSION['id']) and (self::$_instance == null))
		{
			self::$_instance = User::where('id', $_SESSION['id'])->first();
			if (!self::$_instance) {
				self::logOutStatic();
			}
		}
		return self::$_instance;
	}

    static function userOnly() {
		if (!self::isUser()) {
			header('Location: /');
			exit;
		}
	}

	static function isUser() {
		if (isset($_SESSION['user']) and ($_SESSION['user'] == "user") ) {
			return true;
		} else {
			return false;
		}
	}
}
