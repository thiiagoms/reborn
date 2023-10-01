<?php

namespace App\Models\Site;

use App\Models\Endpoints\Endpoint;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * Mass insert fields
     *
     * @var array<string>
     */
    protected $fillable = ['name' , 'description' , 'user_id'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function endpoints(): HasMany
    {
        return $this->hasMany(Endpoint::class);
    }
}
