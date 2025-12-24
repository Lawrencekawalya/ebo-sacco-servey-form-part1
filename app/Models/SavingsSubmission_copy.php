<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class SavingsSubmission_copy extends Model
{
    protected $fillable = [
        'email',
        'status',
        'confirmation_token',
        'confirmed_email',
        'answers',
        'token_expires_at',
        'confirmed_at',
        'submitted_at',
    ];

    protected $casts = [
        'answers' => 'array',
        'submitted_at' => 'datetime',
        'token_expires_at' => 'datetime',
        'confirmed_at' => 'datetime',
    ];

    /**
     * Check if submission is already confirmed
     */
    public function isConfirmed(): bool
    {
        return $this->status === 'confirmed';
    }

    /**
     * Check if confirmation token is still valid
     */
    public function tokenIsValid(): bool
    {
        return $this->confirmation_token !== null
            && $this->token_expires_at !== null
            && now()->lessThanOrEqualTo($this->token_expires_at);
    }
}
