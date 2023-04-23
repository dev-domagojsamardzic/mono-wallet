<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [ 'code', 'start_date', 'end_date', 'amount', 'quota' ];

    // Cast dates as Carbon objects
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public static function boot(): void
    {
        parent::boot();

        static::creating(fn (Model $model) =>
            $model->code = strtoupper(Str::random(12)),
        );
    }

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
