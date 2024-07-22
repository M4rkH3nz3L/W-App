<?php

namespace Modules\CMS\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id', 'views', 'language_id', 'author_user_id',
        'status', 'password', 'title', 'description', 'excerpt', 'keywords',
        'content', 'media_id', 'media_group_id'
    ];

}
