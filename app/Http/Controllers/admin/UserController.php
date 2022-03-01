<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('can:edit-admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request('user_search');
        
        if($search) {
            $users = User::where('name', 'like', '%'.$search.'%')
                        ->orWhere('email', 'like', '%'.$search.'%')
                        ->orWhere('registration', 'like', '%'.$search.'%')->paginate(10);
        } else {
            $users = User::paginate(10);
        }
        
        $loggedId = intval(Auth::id());

        return view('admin.users.index', [
            'users' => $users,
            'loggedId' => $loggedId,
            'search' => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'email',
            'password',
            'password_confirmation',
            'admin',
            'driver',
            'registration'
        ]);

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:100' ],
            'email' => ['required', 'string', 'email', 'max:200', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed']
        ]);

        if(!empty($data['admin'])) {
            $data['admin'] = 1;
        } else {
            $data['admin'] = 0;
        }

        if(!empty($data['driver'])) {
            $data['driver'] = 1;
        } else {
            $data['driver'] = 0;
        }

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $ext = $request->image->extension();
            $imageName = strtolower(str_replace(" ", "", $data['name'])).'.'.$ext;
            $request->file('image')->move(public_path('media/images/profile'), $imageName);
        }

        if($validator->fails()) {
            return redirect()->route('users.create')
            ->withErrors($validator)
            ->withInput();
        }

        $user = new User;
        $user->name = $data['name'];
        $user->registration = $data['registration'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->admin = $data['admin'];
        $user->driver = $data['driver'];
        $user->save();

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if($user) {
            return view('admin.users.edit', [
                'user' => $user
            ]);
        }
        return redirect()->route('users.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if($user) {
            $data = $request->only([
                'name',
                'email',
                'password',
                'password_confirmation',
                'admin',
                'driver',
                'registration'
            ]);
            $validator = Validator::make([
                'name' => $data['name'],
                'email' => $data['email']
            ], [
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:100']
            ]);

            // Alteração do Nome
            $user->name = $data['name'];

            //Alteração da Matrícula
            $user->registration = $data['registration'];

            // Alteração do email
            if($user->email != $data['email']) {
                $hasEmail = User::where('email', $data['email'])->get();
                if(count($hasEmail) === 0) {
                    $user->email = $data['email'];
                } else {
                    $validator->errors()->add('email', __('validation.unique', [
                        'attribute' => 'email'
                    ]));
                }
            }

            // Alteração da Senha
            if(!empty($data['password'])) {
                if(strlen($data['password']) >= 4) {
                    if($data['password'] === $data['password_confirmation']) {
                        $user->password = Hash::make($data['password']);
                    } else {
                        $validator->errors()->add('password', __('validation.confirmed', [
                            'attribute' => 'password'
                        ]));
                    }
                } else {
                    $validator->errors()->add('password', __('validation.min.string', [
                        'attribute' => 'password',
                        'min' => 4
                    ]));
                }
            }

            // Alteração do Perfil
            if(!empty($data['admin'])) {
                $data['admin'] = 1;
            } else {
                $data['admin'] = 0;
            }
            $user->admin = $data['admin'];

            if(!empty($data['driver'])) {
                $data['driver'] = 1;
            } else {
                $data['driver'] = 0;
            }
            $user->driver = $data['driver'];

            //alteração da imagem
            if($request->hasFile('image') && $request->file('image')->isValid()) {
                $ext = $request->image->extension();
                $imageName = strtolower(str_replace(" ", "", $data['name'])).'.'.$ext;
                $request->file('image')->move(public_path('media/images/profile'), $imageName);
            }

            if(count($validator->errors()) > 0) {
                return redirect()->route('users.edit', [
                    'user' => $id
                ])->withErrors($validator);
            }

            $user->save();
        }

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loggedId = intval(Auth::id());

        if($loggedId !== intval($id)) {
            $user = User::find($id);
            $user->delete();
        }

        return redirect()->route('users.index');
    }
}
