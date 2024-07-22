<?php

namespace Modules\CMS\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\CMS\Database\Factories\NavigatorItemFactory;

class NavigatorItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name','description','keywords','url','target','slug','icon'];
    public function navigator()
    {
        return $this->belongsTo(Navigator::class);
    }

    public function parent()
    {
        return $this->belongsTo(NavigatorItem::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(NavigatorItem::class, 'parent_id');
    }
}
