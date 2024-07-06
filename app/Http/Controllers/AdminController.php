<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\RentLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index() {
        // return view()
    }

    public function unconfirmed_user() {
        $users = User::where("confirmed", "=", 0)->get();
        
        return view("", ['users' => $users]);
    }

    public function approve_user(string $username) {
        $updated = User::where("username", "=", $username)->update(['confirmed', 1]);

        if (!$updated) {
            return redirect("/")->withErrors("failed to update user data");
        }

        return redirect(".");
    }

    public function add_book_category(Request $request) {
        $category = new Category;

        $category->name = $request->category_name;

        $category->save();

        return redirect("/");
    }

    public function store_book(Request $request) {
        $validate = $request->validate([
            // 'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'status' => 'required|boolean',
            'cover' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        
        $uuid = Str::uuid()->toString();
        $imageName = $uuid.'.'.$request->cover->extension();
        $request->cover->move(public_path('images'), $imageName);

        $title = $validate['title'];
        
        $book = new Book;
        $book->title = $title;
        $book->status = $validate['status'];
        $book->slug = Str::slug(strtolower($title));
        $book->cover = 'images/'.$imageName;
        $book->description = $validate['description'];

        $book->save();

        $book->categories()->attach($request->category);
        


        return redirect('book-table')->with('status', 'The book has been added');
    }

    public function index_update_book(Request $request, string $book_code) {
        $book = Book::where('book_code', '=', $book_code)->first();
        $selectedCategories = [];
        $selectedCategories = DB::table('book_categories')->where('book_code', $book->book_code)->pluck('category_id')->toArray();
        // Category::where('book_code', '=', $book_code)->first();

        if ( !$book ) {
            // redirect ke halaman create atau update buku 
            return redirect("../../dashboard/buku")->withErrors('book not found in database');
        }

        $category = $book->categories()->get();

        if ( !$category ) {
            // redirect ke halaman create atau update buku 
            return redirect("../../dashboard/buku/edit-book/" . $book_code)->withErrors('categories not found in database');
        }
        

        $url = $request->fullUrl();

        $parsed_path_url = parse_url($url)['path'];

        $segments = explode('/', trim($parsed_path_url, '/'));

        $result = [];

        foreach ($segments as $index => $segment) {
            $result['segment' . ($index + 1)] = $segment;
        }

        // dd($book->book_code);

        $categories = Category::all();

        $books = [];

        return view("admin.dashboard", ['book' => $book, 'result' => $result, 'books' => $books, 'category' => $category, 'categories' => $categories, 'selectedCategories'=>$selectedCategories]);
    }

    public function book_upload(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            // 'status' => 'required|boolean',
            'cover' => 'image|mimes:jpeg,png,jpg|max:2048',
            // 'book_file' => 'file|mimes:pdf,doc,docx,epub|max:10240'
        ]);
    
        $coverFilePath = null;
        $bookFilePath = null;
    
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverFilePath = 'covers/' . time() . '_' . $cover->getClientOriginalName();
            $cover->move(public_path('covers'), $coverFilePath);
        }

        $title = $validated['title'];

        $uuid = Str::uuid()->toString();
    
        $book = new Book;
        $book->book_code = $uuid;
        $book->title = $title;
        $book->slug = Str::slug(strtolower($title));
        $book->description = $validated['description'];
        $book->status = 1;
        $book->cover = $coverFilePath;
        // $book->book_file = $bookFilePath;

        $book->save();
        
        if ($request->has('category')) {
            // dd($request->category);
            $categories = $request->input('category');
            // dd($categories);
            foreach ($categories as $category_id) {
                DB::table('book_categories')->insert([
                    'book_code' => $book->book_code,
                    'category_id' => $category_id
                ]);
            }
        }
    
        return redirect()->back()->with('status', 'success');
    }    
    public function update_book(Request $request, string $book_code) {
        $book = Book::where("book_code", "=", $book_code)->first();
    
        if ($book == null) {
            return redirect("../../books")->withErrors("book not found in database");
        }
    
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'cover' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
    
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $filePath = 'covers/';
            $fileName = time() . '_' . $cover->getClientOriginalName();
            $cover->move(public_path($filePath), $fileName);
            $book->cover = $filePath . $fileName;
        }
    
        $book->book_code = $book_code;
        $book->title = $validated['title'];
        $book->description = $validated['description'];
        $book->status = 1;
        $book->save();
    
        if ($request->has('category')) {
            $newCategories = $request->input('category');
            $existingCategories = DB::table('book_categories')->where('book_code', $book_code)->pluck('category_id')->toArray();
    
            if (count($newCategories) == count($existingCategories)) {
                foreach ($newCategories as $index => $category_id) {
                    DB::table('book_categories')
                        ->where('book_code', $book_code)
                        ->where('category_id', $existingCategories[$index])
                        ->update(['category_id' => $category_id]);
                }
            } else {
                // Tambah kategori baru
                $categoriesToAdd = array_diff($newCategories, $existingCategories);
                if (count($categoriesToAdd) > 0) {
                    foreach ($categoriesToAdd as $category_id) {
                        DB::table('book_categories')->insert([
                            'book_code' => $book->book_code,
                            'category_id' => $category_id
                        ]);
                    }
                }
    
                // Hapus kategori yang tidak ada dalam newCategories
                $categoriesToRemove = array_diff($existingCategories, $newCategories);
                if (count($categoriesToRemove) > 0) {
                    DB::table('book_categories')
                        ->where('book_code', $book_code)
                        ->whereIn('category_id', $categoriesToRemove)
                        ->delete();
                }
            }
        }
    
        return redirect("../../dashboard/buku");
    }
    
    // public function update_book(Request $request, string $book_code) {
    //     $book = Book::where("book_code", "=", $book_code)->first();

    //     if ( $book == null ) {
    //         return redirect("../../books")->withErrors("book not found in database");
    //     }

    //     // dd($request->all());

    //     $validated = $request->validate([
    //         // 'name' => 'required|string|max:255',
    //         'title' => 'required|string|max:255',
    //         // 'book_code' => 'required|uuid',
    //         'description' => 'required|string|max:255',
    //         // 'status' => 'required|boolean',
    //         'cover' => 'image|mimes:jpeg,png,jpg|max:2048'
    //     ]);

    //     if ($request->hasFile('cover')) {
    //         $cover = $request->file('cover');
    //         $filePath = 'covers/';

    //         // ganti nama
    //         $fileName = time() . '_' . $cover->getClientOriginalName();
    //         // pindahkan file gambar
    //         $cover->move(public_path($filePath), $fileName);
    
    //         // Set the book cover path
    //         $book->cover = $filePath . $fileName;
    //     }

    //     $book->book_code = $book_code;
    //     $book->title = $validated['title'];
    //     $book->description = $validated['description'];
    //     $book->status = 1;

    //     $book->save();

    //     // dd($request->category);

    //     // $book->categories()->attach($request->category);
    //     if ($request->has('category')) {
    //         $categories = $request->input('category');
    //         // dd($categories);
    //         foreach ($categories as $category_id) {
    //             if ($book->book_code != $category_id){
    //                 DB::table('book_categories')->insert([
    //                     'book_code' => $book->book_code,
    //                     'category_id' => $category_id
    //                 ]);
    //             }else{
    //                 DB::table('book_categories')
    //                 ->where('book_code', $book->book_code)
    //                 ->update([
    //                     'category_id' => $category_id
    //                 ]);
    //             }
    //         }
    //     }

    //     return redirect("../../dashboard/buku");
    // }

    public function book_list_rented() {
        $books = Book::all()->where('status', '=', 1);

        if (count($books) == 0) {
            // return
        }

        // return view();
    }

    // public function list_user() {
    //     User::all();
    // }


    public function dashboard(Request $request, $section) {
        error_log('knt: ' . $request->fullUrl());
        $url = $request->fullUrl();
    
        $parsed_path_url = parse_url($url);
        $parsed_path_url = isset($parsed_path_url['path']) ? $parsed_path_url['path'] : '';
    
        $segments = explode('/', trim($parsed_path_url, '/'));
    
        $result = [];
        $pinjam = [];
        $users = [];
        $logs = [];
        $categories = [];
        $confirm = [];
        $reqs = [];

        foreach ($segments as $index => $segment) {
            $result['segment' . ($index + 1)] = $segment;
        }
    
        $books = [];
    
        if (in_array('buku', $result)) {
            $category_id = $request->query('category');
            $search = $request->query('search');
            
            error_log($category_id);
    
            if ($category_id && empty($search)) {
                $books = Book::leftJoin('book_categories', 'books.book_code', '=', 'book_categories.book_code')
                    ->where('book_categories.category_id', $category_id)
                    ->get();
            } else if (empty($category_id) && $search) {
                $books = Book::where('title', 'like', '%' . $search . '%')->get();
            }
            
            else if ($search && $category_id){
                $books = Book::leftJoin('book_categories', 'books.book_code', '=', 'book_categories.book_code')->where('book_categories.category_id', $category_id)->where('title', 'like', '%' . $search . '%')->get();
            }   
    
            else {
                $books = Book::all();
            }
        }else if(in_array('pinjam', $result)){
            $pinjam = DB::table('book_categories')
            ->join('books', 'book_categories.book_code', '=', 'books.book_code')
            ->join('categories', 'book_categories.category_id', '=', 'categories.id')
            ->select('books.book_code', 'books.title', 'categories.name as category_name', 'books.status')
            ->where('books.status', 0)
            ->get();
    
            // dd($pinjam);
            // return view('admin.dashboard', ['books' => $books]);
        }else if(in_array('user', $result)){
            $users = DB::table('users')->where('role_id', 2)->whereNot('status', null)->get();
        }else if(in_array('log', $result)){
            $logs = DB::table('rent_logs')
            ->whereNotNull('rent_date')
            ->WhereNotNull('return_date')
            ->get();
        }else if(in_array('kategori', $result)){
            $categories = DB::table('categories')->get();
        }else if(in_array('confirm', $result)){
            $confirm = DB::table('rent_logs')
            ->join('books', 'rent_logs.book_code', '=', 'books.book_code')
            ->select('rent_logs.*', 'books.*')
            ->whereNull('rent_logs.rent_date')
            ->orWhereNull('rent_logs.return_date')
            ->where('status', 1)
            ->get();
        }else if(in_array('req', $result)){
            $reqs = DB::table('users')->where('status', null)->get();
        }
            // } else if ($search && $category_id) {
            //     $books = Book::leftJoin('book_categories', 'books.book_code', '=', 'book_categories.book_code')
            //         ->where('book_categories.category_id', $category_id)
            //         ->where('title', 'like', '%' . $search . '%')
            //         ->get();
            // } else {
            //     $books = Book::all();
            // }
        // }
    
        if (in_array('denda', $result)) {
            $currTimeSec = Carbon::now()->timestamp;
        
            $dateDay = Carbon::now()->addDays(3)->timestamp;
        
            $distinctUsernames = RentLog::whereNull('actual_return_date')
                ->distinct()
                ->pluck('username');
        
            $forfeitIds = [];
        
            foreach ($distinctUsernames as $username) {
                $logs = RentLog::where('username', $username)
                    ->whereNull('actual_return_date')
                    ->get(['id']);
                
                foreach ($logs as $log) {
                    $forfeitIds[] = $log->id;
                }
            }
        
            $users = RentLog::leftJoin('users', 'rent_logs.username', '=', 'users.username')
                ->whereIn('users.username', $distinctUsernames)
                ->whereNotNull('rent_logs.rent_date')
                ->whereNotNull('rent_logs.return_date')
                ->distinct('users.username')
                ->get(['users.username', 'users.phone']);
            
            $arr = [];
            foreach ($users as $user) {
                foreach ($forfeitIds as $id) {
                    $rentLog = RentLog::where('id', $id)
                        ->where('username', $user->username)
                        ->whereNotNull('rent_date')
                        ->whereNotNull('return_date')
                        ->where('return_date', '<', Carbon::now()->toDateTimeString())
                        ->first();
                    
                    if ($rentLog) {
                        if (!isset($arr[$user->username])) {
                            $arr[$user->username] = [];
                        }
                        $book_code = $rentLog->book_code;
                        $book = Book::where('book_code', $book_code)->get();
                        if (!in_array($book, $arr[$user->username])) {
                            $arr[$user->username][] = $book;
                        }
                    }
                }
            }

            $uniqueUsers = [];
            foreach ($users as $user) {
                if (!isset($uniqueUsers[$user->username])) {
                    $uniqueUsers[$user->username] = $user;
                }
            }
        
            $categories = Category::all();
        }
        
        return view('admin/dashboard', [
            'result' => $result,
            'section' => $section,
            'books' => $books,
            'pinjam' => $pinjam,
            'users' => $users,
            // 'users' => $uniqueUsers,
            'logs' => $logs,
            'categories' => $categories,
            'confirm' => $confirm,
            'reqs' => $reqs,
            // 'arrs' => $arr
            
        ]);
    }        
    
    public function add_category(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255|unique:categories,name'
        ]);
    
        $category = new Category;
        $category->name = $validated['category'];
        $category->save();
    
        return redirect('../dashboard/kategori')->with('status', 'Category added successfully');
    }
    public function edit_category(Request $request, $category_id)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255|unique:categories,name,' . $category_id
        ]);

        $category = Category::find($category_id);
        
        if (!$category) {
            return redirect('/')->withErrors('Category not found');
        }

        $category->name = $validated['category'];
        $category->save();

        return redirect('../dashboard/kategori')->with('status', 'Category updated successfully');
    }
    
    
    public function view_book_warning() {
        $currTimeSec = Carbon::now()->toDateTimeString();

        $dateDay = Carbon::now()->addDays(3);

        // dd($currTimeSec);

        $logs = RentLog::whereNull('actual_return_date')->get(['id', 'return_date']);

        $forfeit_id = [];
        foreach ($logs as $log) {
            if ($log->return_date < $dateDay->toDateTimeString()) {
                $forfeit_id[] = $log->id;
            }
        }

        // dd($forfeit_id);

        $forfeit_users = RentLog::whereIn('id', $forfeit_id)
        ->distinct('username')
        ->pluck('username');

        // dd($forfeit_users);

        $users = User::whereIn('username', $forfeit_users)->get(['username', 'phone']);

        // dd($forfeit_id);

        // $books = RentLog::where('id', $forfeit_id)->get(['book_code']);
        
        // Book::whereget();

        $arr = [];
        foreach ($users as $user) {
            foreach ($forfeit_id as $id) {
                if (RentLog::where('id', $id)->where('username', $user->username)->where('return_date', '<', $dateDay->toDateTimeString())->exists()) {
                    if (!isset($arr[$user->username])) {
                        $arr[$user->username] = [];
                    }
                    $book_code = RentLog::where('id', $id)->value('book_code');
                    $book = Book::where('book_code', $book_code)->get();
                    $arr[$user->username][] = $book; // Add the id to the array for this username
                }
            }
        }
        return response()->json(['message' => $arr], 200);
    }

    public function admin_verify_member(string $username) {
        $user = User::where('username', $username)->first();

        if(!$user) {
            return redirect()->back()->withErrors('user tidak ditemukan');
        }
        
        $user->update(['status' => 1]);

        return redirect()->back()->withErrors('user berhasil diverify');
    }

    public function ban_member(string $username) {
        $user = User::where('username', $username)->first();

        if(!$user) {
            return redirect()->back()->withErrors('user tidak ditemukan');
        }

        $user->update(['status'=> 0]);

        return redirect()->back()->withErrors('user berhasil diban');
    }
}