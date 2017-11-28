<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(Request $request)
    {

        try {
            $validators = Validator::make($request->all(), [
                'nome' => 'required|string|max:255',
                'username' => 'required|string|min:3|max:10',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|max:16|confirmed',
            ]);
            if ($validators->fails())
                return response('Falha na validação', 401);
            $user = new User();
            $senha = sha1($request->password);
            $user->fill([
                'nome' => $request->nome,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $senha
            ]);
            $user->save();
            return response()->json($user);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 401);
        }
    }
}
