<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'chats';

    protected $fillable = [
        'id',
        'sender_id',
        'receiver_id',
        'text'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function getTimeAttribute(): string {
        return date(
            "d M Y, H:i:s",
            strtotime($this->attributes['created_at'])
        );
    }
    
}
