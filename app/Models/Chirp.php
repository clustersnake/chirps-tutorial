<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chirp extends Model {
    use HasFactory;
    protected $fillable = [
        'message',
    ];

    /**
     * Get the user associated with the Chirp
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
