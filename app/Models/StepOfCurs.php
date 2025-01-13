<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StepOfCurs extends Model
{
    protected $table = 'steps_of_curs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'average_completion_time',
        'previous_id',
        'curs_id'
    ];

    public function urls() {
        return $this->hasMany(StepUrls::class, 'step_id', 'id');
    }

    public function previousStep() {
        return $this->belongsTo(StepOfCurs::class, 'previous_id', 'id');
    }

    public function nextSteps() {
        return $this->hasMany(StepOfCurs::class, 'previous_id', 'id');
    }

    public function curs() {
        return $this->belongsTo(Curs::class, 'curs_id', 'id');
    }

    public function progresses() {
        return $this->hasMany(ProgressUser::class, 'step_id', 'id');
    }
}
