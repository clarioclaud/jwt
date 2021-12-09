<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function __construct(){
		$this->middleware('auth:api',['except' => ['Login','Register']]);
	}
	
	public function Register(Request $request){
		$validate = Validator::make($request->all(),[
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'password' => 'required|min:6',
		]);
		
		if($validate->fails()){
			return response()->json([
				'status' => 'error',
				'message' => $validate->errors()
			],400);
		}
		
		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'created_at' => Carbon::now(),
		]);
		
		if(!is_null($user)){
			return response()->json([
				'status' => 'success',
				'message' => 'Registered Successfully',
			]);
		}else{
			return response()->json([
				'status' => 'error',
				'message' => 'Registration Failed...',
			],201);
		}
	}
	
	public function Login(Request $request){
		$validate = Validator::make($request->all(),[
			'email' => 'required|email',
			'password' => 'required',
		]);
		
		if($validate->fails()){
			return response()->json([
				'status' => 'error',
				'message' => $validate->errors(),
			],400);
		}
		
		if($token = auth()->guard('api')->attempt($validate->validated())){
			return $this->createNewToken($token);
		}else{
			return response()->json([
				'status' => 'error',
				'message' => 'UnAuthorized'
			],401);
		}
	}
	
	public function Profile(){
		return response()->json([
			'status' => 'success',
			'User' => auth()->guard('api')->user(),
		]);
	}
	
	public function Logout(Request $request){
		auth()->logout();
		return response()->json([
			'status' => 'success',
			'message' => 'User Logout Successfully...',
		]);
	}
	
	public function Refresh(){
		return $this->createNewToken(auth()->refresh());
	}
	
	protected function createNewToken($token){
		return response()->json([
			'access_token' => $token,
			'token_type' => 'Bearer',
			'expires_in' => auth()->guard('api')->factory()->getTTL() * 60,
			'User' => auth()->guard('api')->user(),
		]);
	}
}
