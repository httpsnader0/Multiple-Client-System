<?php

namespace App\Models\User;

use App\Enums\UserTypeEnum;
use App\Models\Product\Product;
use App\Models\Product\Purchase;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use InteractsWithMedia, HasApiTokens, Notifiable, HasRoles;

    protected $guarded;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
    ];

    public function getProfileAttribute()
    {
        return $this->getFirstMediaUrl('profile') != '' ? $this->getFirstMediaUrl('profile') : asset('assets/default.png');
    }

    public function scopeActive($query)
    {
        $query->whereActive(1);
    }

    public function scopeAdministrators($query)
    {
        $query->whereType(UserTypeEnum::ADMINISTRATOR());
    }

    public function scopeClients($query)
    {
        $query->whereType(UserTypeEnum::CLIENT());
    }

    public function scopeUsers($query)
    {
        $query->whereType(UserTypeEnum::USER());
    }

    public function getRoleIdAttribute()
    {
        return optional($this->roles->first())->id;
    }

    public function getRoleNameAttribute()
    {
        return $this->roles->first() ? json_decode($this->roles->first()->name, true)[LaravelLocalization::getCurrentLocale()] : '';
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
