<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\RentLogsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('/login');
});

Route::get('/register', function () {
    return view('/register');
});

Route::get('/admin', function () {
    return view('/admin/dashboard');
});

Route::get('/user', function () {
    return view('/admin/dashboard');
});

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', [AuthController::class, 'login_index']);
Route::get('/register', [AuthController::class, 'register_index']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register_acc', [AuthController::class, 'register']);

// fitur 4 dan 5
// Route::get('/books', [BookController::class, "index"]);
Route::get('/books/{book_code}', [AdminController::class, "index_update_book"])->middleware('isAdmin');

// fitur 8
Route::post('/buku', [AdminController::class, "book_upload"])->middleware('isAdmin');
Route::put('/books/update/{book_code}', [AdminController::class, "update_book"])->middleware('isAdmin');
Route::post('/category', [AdminController::class, "add_book_category"])->middleware('isAdmin');

//fitur 6, 7, 9
Route::post('/rent_book', [RentLogsController::class, "borrow_book"])->middleware('isMember');
Route::get('/invoice/{book_code}', [ReaderController::class, "create_invoice"])->middleware('isMember');
Route::get('/invoice/{book_code}/{id}', [ReaderController::class, "show_invoice"])->middleware('isMember');

//fitur 11
Route::get('/rented_books', [AdminController::class, "book_list_rented"]);

//fitur 12
Route::get('/forfeits', [RentLogsController::class, "user_forfeit"]);

//fitur 13
Route::get('/books/log_book/{book_code}', [RentLogsController::class, "log_rent_book"]);

Route::get('/dashboard/home', [BookController::class, 'index']);
Route::get('/dashboard/histori', [BookController::class, 'index'])->middleware('isMember');
Route::get('/books/{book_code}', [BookController::class, "book_detail"]);

// Route::get('*', function() {
//     return view("not_found");
// });
Route::post('/dashboard/add-category', [AdminController::class, 'add_category'])->name('add.category')->middleware('isAdmin');
Route::post('/edit-category/{category_id}', [AdminController::class, 'edit_category'])->name('edit.category')->middleware('isAdmin');

Route::get('/dashboard/{section}', [AdminController::class, 'dashboard'])->middleware('isAdmin');
Route::get('/dashboard/denda/all', [AdminController::class, 'view_book_warning'])->middleware('isAdmin');
Route::put('/update/denda/{username}', [RentLogsController::class, 'update_status_denda'])->middleware('isAdmin');

Route::get('/dashboard/buku/edit-buku/{book_code}', [AdminController::class, 'index_update_book'])->middleware('isAdmin');
Route::get('/dashboard/buku/tambah-buku', [ComponentController::class, 'index_add_book'])->middleware('isAdmin');

Route::get('/dashboard/buku/{any}', function () {
    return redirect('/dashboard/buku');
})->where('any', '.*')->middleware('isAdmin');;

Route::get('/dashboard/buku/edit-buku/{any}', function () {
    return redirect('/dashboard/buku');
})->where('any', '.*')->middleware('isAdmin');;

Route::put('/pinjam/{book_code}/user/{username}', [RentLogsController::class, 'update_status_buku'])->middleware('isAdmin');
Route::put('/verify/{username}', [AdminController::class, 'admin_verify_member'])->middleware('isAdmin');
Route::put('/ban/{username}', [AdminController::class, 'ban_member'])->middleware('isAdmin');
Route::get('/dashboard/denda/status/all', [RentLogsController::class, 'bool_status_denda'])->middleware('isAdmin');

Route::get('/logout', [ReaderController::class, 'logout']);


