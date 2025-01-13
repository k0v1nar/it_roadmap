<?php

namespace App\Components\admin;

use Illuminate\Support\Facades\Auth as AuthLaravel;

class Auth extends AuthLaravel
{
	static function isSuperAdmin() {
		if ((Auth::check()) and (Auth::user()->role_id === 1) ) {
			return true;
		} else {
			return false;
		}
	}

	static function isAdmin() {
		if ((Auth::check()) and (Auth::user()->role_id === 1 or Auth::user()->role_id === 2) ) {
			return true;
		} else {
			return false;
		}
	}
    
	static function isEditor() {
		if ((Auth::check()) and (Auth::user()->role_id === 1 or Auth::user()->role_id === 2 or Auth::user()->role_id === 3) ) {
			return true;
		} else {
			return false;
		}
	}
}