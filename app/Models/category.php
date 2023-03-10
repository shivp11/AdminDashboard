<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class category extends Model
{
    
    use HasApiTokens, HasFactory, Notifiable;
    public $timestamps = false;
    // public $table = "categories";
    protected $fillable = [
        'cat_title',
    ];
}
