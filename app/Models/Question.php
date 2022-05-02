<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\QueriesRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function views() {
        return $this->hasMany(QuestionView::class);
    }

    public function rates()
    {
        return $this->morphMany(Rate::class, 'rateable');
    }

}
