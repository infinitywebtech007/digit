<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    /** @use HasFactory<\Database\Factories\CallFactory> */
    use HasFactory;

    protected $fillable = [
        'call_id',
        'type',
        'date',
        'party_id',
        'user_id',
        'reported_problem',
        'action_taken',
        'status',
        'next_follow_up_date',
        'priority',
    ];

    public function party()
    {
        return $this->belongsTo(Party::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
