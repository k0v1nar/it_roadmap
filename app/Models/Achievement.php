<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $table = 'achievements';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'path_icon',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_achievement', 'achievement_id', 'user_id')->withTimestamps();
    }
}
