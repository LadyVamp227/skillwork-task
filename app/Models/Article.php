<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Article extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'content',
        'author',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'author');
    }
}
