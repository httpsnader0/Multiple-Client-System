<?php

namespace App\Models\User;

use Spatie\Permission\Models\Role as ModelRole;
use Spatie\Translatable\HasTranslations;

class Role extends ModelRole
{
    use HasTranslations;

    public $translatable = [
        'name',
    ];

    public function scopeActive($query)
    {
        $query->whereActive(1);
    }
}
