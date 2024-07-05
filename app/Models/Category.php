<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'categories';

    public $incrementing = false;
    public $timestamps = false;

    public function book() {
        return $this->hasMany(Book::class);
    } 

    protected $fillable = [
        'name'
    ];
}
