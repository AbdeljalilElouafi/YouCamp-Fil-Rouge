<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    
    public function showLoginForm()
    {
        return view('auth.login');
    }

    
    public function login(Request $request)
    {
        
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
    
            $user = Auth::user();
    
            
            if ($user->hasRole('manager') && $user->status !== 'active') {
                Auth::logout(); 
                return redirect()->route('pending.activation')->with('message', 'Sorry, your account has not been activated yet. We will be in touch as soon as possible.');
            }
    
           
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('manager')) {
                return redirect()->route('manager.dashboard');
            } else {
                return redirect()->route('visitor.home');
            }
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    
    public function register(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,manager',
        ]);
    
        $status = $request->role === 'manager' ? 'pending' : 'active';
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => $status,
        ]);
    
        
        $role = Role::where('name', $request->role)->first();
        $user->roles()->attach($role);
    
        
        if ($status === 'active') {
            Auth::login($user);
            return redirect('/dashboard');
        }
    
        
        return redirect()->route('pending.activation')->with('message', 'Thank you for registering! Your account is pending activation. We will be in touch as soon as possible.');
    }
    
   
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}