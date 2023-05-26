<?php

namespace App\Models\Product;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $guarded;

    public function scopeByUser($query, $userId = null)
    {
        $query->whereUserId($userId ?? auth()->user()->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
