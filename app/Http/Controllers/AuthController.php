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
            $role_user = User::where('username', '=', $username)->select('role_id')->first();
    
            if (!$role_user) {
                return redirect('login')->withErrors(['username' => 'No role assigned to this username']);
            }
    
            $admin = false;
            $roles = [];
    
            if ($role_user->role_id == 1) {
                $admin = true;
            } else {
                array_push($roles, $role_user->role_id);
            }
    
            // $request->session()->put('user', [
            //     'username' => $username,
            //     'role_id' => $role_user->role_id
            // ]);
    
            if ($admin) {
                return redirect('/admin/dashboard');
            }
    
            if (count($roles) == 1 && in_array(2, $roles)) {
                return redirect('/books');
            }
    
            $roles_tb = Role::select('id', 'name')->where('id', '>=', 3)->get();
    
            foreach ($roles_tb as $role) {
                if (in_array($role->id, $roles)) {
                    return redirect()->route($role->name . '.dashboard');
                }
            }
    
            return redirect('login')->withErrors(['username' => 'No appropriate role assigned to this username']);
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
            ]);
        
            $new_user = new User;
            // $new_user->name = $validate['name'];
            $new_user->username = $validate['username'];
            $new_user->password = bcrypt($validate['password']);
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
            return response()->json(['error' => 'Failed to register user', 'message' => $e->getMessage()], 500);
        }

    
    }
}
