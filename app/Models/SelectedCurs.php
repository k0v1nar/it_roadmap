<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectedCurs extends Model
{
    protected $table = 'selected_curs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'curs_id',
        'progress',
        'is_finish',
        'date_of_finish'
    ];

    public function curs() {
        return $this->belongsTo(Curs::class, 'curs_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function steps() {
        return $this->hasMany(ProgressUser::class, 'curs_id', 'id');
    }
}
