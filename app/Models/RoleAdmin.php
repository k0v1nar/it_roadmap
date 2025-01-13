<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleAdmin extends Model
{
    protected $table = 'roles_admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($role) {
            $role->admins()->update(['role_id' => null]);
        });
    }

    public function admins() {
        return $this->hasMany(Admin::class, 'role_id', 'id');
    }
}
