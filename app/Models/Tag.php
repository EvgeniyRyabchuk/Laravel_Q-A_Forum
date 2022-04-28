<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function question() {
        return $this->belongsToMany(Question::class);
    }
    public static function findOrCreate($id)
    {
        $obj = static::find($id);
        return $obj ?: new static;
    }
}
