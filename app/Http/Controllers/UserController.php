<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Lcobucci\JWT\Parser as JwtParser;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\UnencryptedToken;
use Illuminate\Support\Facades\Redirect;
// use HasApiTokens;

class UserController extends Controller
{

    protected $jwt;

    public function __construct(JwtParser $jwt)
    {
        $this->jwt = $jwt;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.login');
    }
    public function index1()
    {


        return view('user.register');
    }


    public function auth(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        if ($validator->fails()) {
            return response()->json(["validation_errors" => $validator->errors()]);
            // echo "error";
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('token')->accessToken;

            Session::put('user_token', $token);
            // $request->session()->put('user_token', $token);
            // session(['user_token' => $token]);

            return redirect('user/dashboard');

            // return response()->json(["status" => "success", "success" => true, "login" => true, "token" => $token,"data" => $user]);
            // return response()->json([ [1] ]);


        } else {
            $request->session()->flash('error', "please Enter Correct Email And Password");
            return redirect('login');
            // return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! invalid email or password"]);
            // return response()->json([ [3] ]);

        }
    }

    public function dashboard(Request $request)
    {
        return view('user/dashboard');
    }
    public function logout()
    {
        // session()->forget('user');
        // session()->flash('error', 'Logout succesfully.');
        // return redirect('login');
        auth()->logout();
        return redirect('login');

    }
    public function userDetail()
    {
        $user = Auth::user();
        if (!is_null($user)) {
            return response()->json(["status" => "success", "success" => true, "user" => $user]);
        } else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! no user found"]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:2|max:50|alpha',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8'
            ]
        );

        if ($validator->fails()) {
            // return response()->json(["validation_errors" => $validator->errors()]);
            // return $validator->errors();
            return Redirect::back()->withErrors($validator);
        }

        $dataArray = array(
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),

        );

        $user = User::create($dataArray);

        if (!is_null($user)) {
            // return response()->json(["status" => "Success", "success" => true, "data" => $user]);
            return redirect('login');
        } else {
            // return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! user not created. please try again."]);
            return redirect('register');
            
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
