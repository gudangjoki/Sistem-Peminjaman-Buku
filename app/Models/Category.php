<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $timestamp = false;

    public function book() {
        return $this->hasMany(Book::class);
    } 

    protected $fillable = [
        'name'
    ];
}
