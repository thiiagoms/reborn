<?php

namespace App\Models\Endpoints;

use App\Models\Site\Site;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Endpoint extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'http',
        'frequency',
        'frequency_interval',
        'payload',
        'site_id'
    ];

    /**
     * @return BelongsTo
     */
    public function sites(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
}
