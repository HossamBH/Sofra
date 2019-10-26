<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ResetPassword;
use App\Models\Token;

class AuthController extends Controller
{
    public function signup(Request $request)
	{
		$validator = validator()->make($request->all(),[
			'name' => 'required',
			'phone' => 'required|unique:clients',
			'password' => 'required|confirmed',
			'email' => 'required|unique:clients',
			'neighborhood_id' => 'required',
		]);

		if ($validator->fails())
		{
			return responseJson(0,$validator->errors()->first(),$validator->errors());
		}
		$request->merge(['password' => bcrypt($request->password)]);
		$client = Client::create($request->all());

		$client->api_token = Str::random(60);
		$client->save();
		return responsejson(1,'success',[
			'api_token' => $client->api_token,
			'client' => $client
		]);
	}

	public function login(Request $request)
	{
		$validator = validator()->make($request->all(),[
			'email' => 'required',
			'password' => 'required',
		]);
		if ($validator->fails())
		{
			return responsejson(0,$validator->errors()->first(),$validator->errors());
		}	
		$client = Client::where('email',$request->email)->first();

		if ($client)
		{
			if (Hash::check($request->password,$client->password))
			{
				return responseJson(1,'success',[
				'api_token' => $client->api_token,
				'client' => $client
				]);
			}
			else
			{
				return responseJson(0,'errorpassword');
			}
		}
		else
			{
				return responseJson(0,'error');
			}
	}

	public function resetPassword(Request $request)
	{
		$validator = validator()->make($request->all(),[
			'email' => 'required',
		]);
		if ($validator->fails())
		{
			return responsejson(0,$validator->errors()->first(),$validator->errors());
		}

		$client = Client::where('email',$request->email)->first();

		if ($client)
		{
			$pin = rand(1111,9999);
			$update = $client->update(['pin_code' => $pin]);
			
			if($update)
			{
				Mail::to($client->email)
				    ->bcc("testwork094@gmail.com")
				    ->send(new ResetPassword($pin));
				return responsejson(1,'success', $pin);
			}
			else
			{
				return responsejson(0,'error');
			}
		}
		else
		{
			return responsejson(0,'error');
		}
	}

	public function newPassword(Request $request)
	{
		$validator = validator()->make($request->all(),[
			'pin_code' => 'required',
			'password' => 'required|confirmed',
			'password_confirmation' => 'required',

		]);

		if ($validator->fails())
		{
			return responsejson(0,$validator->errors()->first(),$validator->errors());
		}

		$client = Client::where('pin_code', $request->pin_code)->first();

		if ($client)
		{
			$request->merge(['password' => bcrypt($request->password)]);
			$update = $client->update(['password' => $request->password]);
			$update = $client->update(['pin_code' => null]);
			return responsejson(1,'success');
		}
		else
		{
			return responsejson(0,'error');
		}
	}

	public function registerToken(Request $request)
	{
		$validator = validator()->make($request->all(),[
			'token' => 'required',
			'type' => 'required|in:android,ios',
		]);

		if ($validator->fails())
		{
			return responsejson(0,$validator->errors()->first(),$validator->errors());
		}	

		Token::where('token',$request->token)->delete();

		$request->user()->tokens()->create($request->all());
		return responsejson(1,'success');
	}

	public function removeToken(Request $request)
	{
		$validator = validator()->make($request->all(),[
			'token' => 'required',
		]);

		if ($validator->fails())
		{
			return responsejson(0,$validator->errors()->first(),$validator->errors());
		}	

		Token::where('token',$request->token)->delete();
		return responsejson(1,'success');
	}
}
