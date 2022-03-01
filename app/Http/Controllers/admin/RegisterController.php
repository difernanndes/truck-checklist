<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    //use RegisterUsers;

    protected $redirectTo = '/';   

    public function __construct() {
        $this->middleware('guest');
    }

    public function index() {
        return view('admin.register');
    }

    public function register(Request $request) {
        $data = $request->only([
            'name',
            'email',
            'password',
            'password_confirmation'
        ]);

        $validator = $this->validator($data);
        
        if($validator->fails()) {
            return redirect()->route('register')
            ->withError($validator)
            ->withInput();
        }

        $user = $this->create($data);
        Auth::login($user);
        return redirect()->route('home');
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }

    protected function create(array $data) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
