<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'sender_id', 'receiver_id', 'job_id', 'message', 'file_path', 'file_type', 'read_at'
    ];

    protected $casts = [
        'read_at' => 'datetime'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
