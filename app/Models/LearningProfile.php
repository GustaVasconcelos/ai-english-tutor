<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningProfile extends Model
{
    protected $fillable = [
        'correct_always',
        'explanation_language',
        'level',
    ];
}