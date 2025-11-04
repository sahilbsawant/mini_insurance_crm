<?php

namespace App\Models;

use App\Models\User;
use App\Models\Policy;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name','email','phone','address','created_by'
    ];

    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

   public function policies()
{
    return $this->hasMany(Policy::class);
}

public function tickets()
{
    return $this->hasMany(Ticket::class);
}


}
