<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    use HasFactory;

    protected $table = 'book_categories';

    // Menentukan bahwa tabel ini tidak memiliki primary key
    protected $primaryKey = null;
    public $incrementing = false;

    // Menentukan bahwa tabel ini tidak menggunakan timestamps
    public $timestamps = false;

    // Daftar kolom yang dapat diisi secara massal
    protected $fillable = [
        'book_code',
        'category_id',
    ];

    // Relasi dengan buku
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_code', 'book_code');
    }

    // Relasi dengan kategori
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
