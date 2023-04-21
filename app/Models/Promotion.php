<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'start_date', 'end_date', 'amount', 'quota'];

    // Cast dates as Carbon objects
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    /**
     * The Users that belong to the Promotion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'promotion_users');
    }
}
