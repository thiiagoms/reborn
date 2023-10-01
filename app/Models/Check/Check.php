<?php

namespace App\Models\Check;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'check';

    /**
     * Mass insert fields
     *
     * @var array
     */
    protected $fillable = ['endpoint_id' , 'site_id' , 'http_code', 'long_text', 'last_check', 'next_check'];

    /**
     * Hidden fields
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];
}
