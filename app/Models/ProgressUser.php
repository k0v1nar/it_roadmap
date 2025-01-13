<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressUser extends Model
{
    protected $table = 'progress_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'step_id',
        'is_finish',
        'date_of_finish'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function step() {
        return $this->belongsTo(StepOfCurs::class, 'step_id', 'id');
    }
}
