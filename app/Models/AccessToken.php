<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    protected $fillable = ['token', 'expired_at'];

    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }
}
