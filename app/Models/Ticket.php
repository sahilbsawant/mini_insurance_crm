<?php

namespace App\Models;

use App\Models\User;
use App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    protected $fillable = [
        'subject',
    'description',
    'status',
    'client_id',
    'created_by',
    'assigned_to',
    'escalated_from',   
    'escalated_to',    
    'escalate_at',       
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function escalatedFromUser()
    {
        return $this->belongsTo(User::class, 'escalated_from');
    }
}
