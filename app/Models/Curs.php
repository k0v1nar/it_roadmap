<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curs extends Model
{
    protected $table = 'curs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'purpose',
        'average_completion_time',
        'first_step_id',
        'path_icon'
    ];

    public function first_step() {
        return $this->belongsTo(StepOfCurs::class, 'first_step_id', 'id');
    }

    public function selected() {
        return $this->hasMany(SelectedCurs::class, 'curs_id', 'id');
    }
}
