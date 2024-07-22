<?php

namespace Modules\CMS\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\CMS\Database\Factories\NavigatorFactory;

class Navigator extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name','author_user_id','description'];

    public function items()
    {
        return $this->hasMany(NavigatorItem::class);
    }
}
