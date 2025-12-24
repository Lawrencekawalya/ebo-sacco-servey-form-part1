<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavingsSubmission extends Model
{
    protected $fillable = [
        'answers',
        'submitted_at',
    ];

    protected $casts = [
        'answers' => 'array',
        'submitted_at' => 'datetime',
    ];
}
