<?php

namespace App\Http\Controllers;

use App\Mail\AdminMail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index(){
        return view('index');
    }
    public function about(){
        return view('about');
    }
    public function login(){
        return view('login');
    }

    public function login_submit(Request $request){
        if($request->isMethod('post')){
            //validating data
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:5' 
            ]);

            //checking data
            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];

            if(Auth::guard('admin')->attempt($credentials)){
                $request->session()->regenerate();
                return redirect()->route('front.home');
            }

            return back()->withErrors([
                'fail' => 'The provided credentials do not match our records.'
            ])->onlyInput('fail');

        }
        return redirect()->back();
        
    }

    public function forgot(){
        return view('forget-password');
    }
    public function forgot_submit(Request $request){
        $admin = Admin::where('email', $request->email)->first();
        if(!$admin){
            return redirect()->back()->withErrors([
                'fail' => 'Email not found'
            ])->onlyInput();
        }
        // Generate a token number
        $token = Hash::make($request->email);
        // update to the database
        $admin->token = $token;
        $admin->update();

        // Send email
        $subject = 'Reset Password';
        $reset_url = route('front.reset.password').'/'.$token.'/'.$request->email; 
        Mail::to($request->email)->send(new AdminMail($subject, $reset_url));

        return redirect()->back()->with('success', 'Email sent successfully ! Please check.');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('front.login');
    }


}
