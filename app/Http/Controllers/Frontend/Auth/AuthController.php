<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

class AuthController extends Controller
{
    public function showRegisterForm() {
        return view('frontend.auth.register');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'msg' => $validator->errors()->first()
            ]);
        }

        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return response()->json([
                'success' => true,
                'msg' => 'Login successful!'
            ]);
        }

        return response()->json([
            'success' => false,
            'msg' => 'Invalid credentials. Please try again.'
        ]);
    }
    
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:customers',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'msg' => $validator->errors()->first()
            ]);
        }

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_suspend' => 0 
        ]);

        return response()->json([
            'success' => true,
            'msg' => 'Registration successful! Please log in.'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index')->with('success', 'You have successfully logged out!');
    }
}
