<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Token;
use Illuminate\Support\Str;
use Mail;
use App\Mail\ResetPassword;

class AuthController extends Controller
{
    public function signup(Request $request)
	{
		$validator = validator()->make($request->all(),[
			'name' => 'required|unique:restaurants',
			'phone' => 'required|unique:restaurants',
			'password' => 'required|confirmed',
			'email' => 'required|unique:restaurants',
			'min_charge' => 'required',
			'delivery' => 'required',
			'image' => 'required',
			'neighborhood_id' => 'required',
		]);

		if ($validator->fails())
		{
			return responseJson(0,$validator->errors()->first(),$validator->errors());
		}
		$request->merge(['password' => bcrypt($request->password)]);
		$restaurant = Restaurant::create($request->all());
		if ($request->hasFile('image'))
		{
           $image = $request->image;
           $image_new_name = time() . $image->getClientOriginalName();
           $image->move('uploads/restaurants', $image_new_name);
           $restaurant->image = 'uploads/restaurants/'.$image_new_name;
        }

		$restaurant->api_token = Str::random(60);
		$restaurant->save();
		return responsejson(1,'success',[
			'api_token' => $restaurant->api_token,
			'restaurant' => $restaurant
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
		$restaurant = Restaurant::where('email',$request->email)->first();

		if ($restaurant)
		{
			if (Hash::check($request->password,$restaurant->password))
			{
				return responseJson(1,'success',[
				'api_token' => $restaurant->api_token,
				'restaurant' => $restaurant
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

		$restaurant = Restaurant::where('email',$request->email)->first();

		if ($restaurant)
		{
			$pin = rand(1111,9999);
			$update = $restaurant->update(['pin_code' => $pin]);
			
			if($update)
			{
				Mail::to($restaurant->email)
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

		$restaurant = Restaurant::where('pin_code', $request->pin_code)->first();

		if ($restaurant)
		{
			$request->merge(['password' => bcrypt($request->password)]);
			$update = $restaurant->update(['password' => $request->password]);
			$update = $restaurant->update(['pin_code' => null]);
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
