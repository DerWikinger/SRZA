<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $table = 'chats';

    public function users()
    {
        return $this->belongsToMany(User::class, 'chats_users');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'chat_id');
    }

    public function lastMessage()
    {
        return $this->messages->last();
    }
}
