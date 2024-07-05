<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    public $incrementing = false;
    protected $keyType = 'string';
    
    public $timestamps = false;
    protected $primaryKey = 'book_code';
    
    protected $fillable = [
        'book_code',
        'title',
        'slug',
        'status',
        'cover',
        'description',
    ];

    public function users() {
        return $this->belongsToMany(User::class, 'rent_logs', 'book_code', 'username');
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'book_categories', 'book_code', 'category_id');
    }
}
