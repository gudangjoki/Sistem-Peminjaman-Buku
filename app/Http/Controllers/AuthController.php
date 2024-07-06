<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login_index() {
        return view('login');
    }

    public function login(Request $request) {
        $username_req = $request->username;
        $user = User::where('username', $username_req)->first();
    
        if ($user && Hash::check($request->password, $user->password)) {
            $username = $user->username;
            $role_user = User::where('username', '=', $username)->whereNotNull('status')->select('role_id', 'status')->first();
    
            if (!$role_user) {
                return redirect()->back()->withErrors(['error' => 'Your account has not verified yet, please contact our admin to verify']);
            }
            
            if ($role_user->status == 0) {
                // dd($role_user->status);
                return redirect()->back()->withErrors(['error' => 'Akun kamu sudah dibanned oleh admin karena belum membayar denda buku']);
            }
    
            $admin = false;
            $roles = [];
    
            if ($role_user->role_id == 1) {
                $admin = true;
            } else {
                array_push($roles, $role_user->role_id);
            }
    
            $request->session()->put('user', [
                'username' => $username,
                'role_id' => $role_user->role_id
            ]);
    
            if ($admin) {
                return redirect('/dashboard/buku');
            }
    
            if (count($roles) == 1 && in_array(2, $roles)) {
                return redirect('/dashboard/home');
            }
    
            $roles_tb = Role::select('id', 'name')->where('id', '>=', 3)->get();
    
            foreach ($roles_tb as $role) {
                if (in_array($role->id, $roles)) {
                    return redirect()->route($role->name . '.dashboard');
                }
            }
    
            return redirect('login')->withErrors(['username' => 'No role found']);
        } else {
            return redirect('login')->withErrors(['username' => 'Invalid username or password']);
        }
    }

    public function register_index() {
        return view('register');
    }

    public function register(Request $request)
    {

        // DB::beginTransaction();
        
        try {

            $validate = $request->validate([
                // 'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'password' => 'required|string',
                'phone' => 'required|string',
                'address' => 'required|string|max:100',
            ]);

            $phone = $validate['phone'];

            if (substr($phone, 0, 1) == '0') {
                $phone = substr($phone, 1);
            }

            $phone = intval($phone);

            $new_user = new User;
            // $new_user->name = $validate['name'];
            $new_user->username = $validate['username'];
            $new_user->password = bcrypt($validate['password']);
            $new_user->phone =  $phone;
            $new_user->address = $validate['address'];
            $new_user->role_id = 1;
            $new_user->save();
    
            // DB::table('role_user')->insert([
            //     'username' => $new_user->username,
            //     'role_id' => 1,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ]);
            // $new_user->role()->attach([1]);
            // DB::commit();

            return redirect('register')->with('status', 'Your account has been created');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to register user', 'message' => $e->getMessage()]);
        }

    
    }
}
