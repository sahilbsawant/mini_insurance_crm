<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{

    protected $fillable = [
        'client_id',
        'policy_type',
        'premium',
        'renewal_date',
        'status',
        'created_by',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
