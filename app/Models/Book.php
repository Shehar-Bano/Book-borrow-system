<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'author', 'category', 'description', 'copies_available', 'status'];
    public function borrowRequests()
    {
        return $this->hasMany(BorrowRequest::class);
    }

}