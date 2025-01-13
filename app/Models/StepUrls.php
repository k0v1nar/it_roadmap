<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StepUrls extends Model
{
    protected $table = 'step_urls';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'url',
        'step_id'
    ];

    public function step() {
        return $this->belongsTo(StepOfCurs::class, 'step_id', 'id');
    }
}
