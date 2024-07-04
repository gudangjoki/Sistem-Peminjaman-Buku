<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public $incrementing = false;

    public $timestamp = false;
    
    protected $fillable = [
        'book_code',
        'title',
        'status',
        'cover',
        'description',
    ];

    public function users() {
        return $this->belongsToMany(User::class, 'rent_logs', 'book_id', 'username');
    }

    public function categories() {
        return $this->belongsTo(Category::class);
    }
}
