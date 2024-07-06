<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentLog extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = 'rent_logs';

    protected $fillable = [
        'id',
        'username',
        'book_code',
        'rent_date',
        'return_date',
        'actual_return_date'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function book() {
        return $this->belongsTo(Book::class, 'book_code', 'book_code');
    }
}
