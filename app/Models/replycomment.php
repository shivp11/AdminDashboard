<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class replycomment extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    public $timestamps = false;
}
