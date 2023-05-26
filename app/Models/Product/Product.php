<?php

namespace App\Models\Product;

use App\Models\User\User;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia, HasTranslations;

    protected $guarded;

    public $translatable = [
        'name',
        'description',
    ];

    public function getCoverAttribute()
    {
        return $this->getFirstMediaUrl('cover') != '' ? $this->getFirstMediaUrl('cover') : asset('assets/default.png');
    }

    public function scopeActive($query)
    {
        $query->whereActive(1);
    }

    public function scopeByUser($query, $userId = null)
    {
        $query->whereUserId($userId ?? auth()->user()->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function getTotalPurchasesAttribute()
    {
        return $this->purchases()->count();
    }
}
