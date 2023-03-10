<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class post extends Model
{
    
    use HasApiTokens, HasFactory, Notifiable;
    public $timestamps = false;
    protected $fillable = [
        'post_author',
        'post_title',
        'post_status',
        'post_comment_count',
        'post_image',
        'post_content',
        'post_category_id',
    ];
}
