<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Neighborhood;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Product;
use App\Models\Review;
use App\Models\Contact;
use App\Models\Offer;
use App\Models\Setting;
use App\Models\PaymentMethod;

class MainController extends Controller
{
    public function cities()
	{
		$cities = City::all();

		return responseJson(1, 'success', $cities);
	}

	public function neighborhoods(Request $request)
	{
		$neighborhoods = Neighborhood::where(function ($query) use($request){

			if ($request->has('city_id'))
			{
				$query->where('city_id',$request->city_id);
			}
		})->get();

		return responsejson(1, 'success', $neighborhoods);
	}

	public function categories()
	{
		$categories = Category::all();

		return responseJson(1, 'success', $categories);
	}

	public function restaurants(Request $request)
	{	
		 $restaurants = Restaurant::where(function ($query){
          if (request()->input('city_id'))
          {
              $query->whereHas('neighborhood', function ($q){
                  $q->where('city_id', request()->city_id);
              });
          }
          if (request()->input('name'))
          {
               $query->where('name', 'like', '%' . request()->name . '%');
          }
       })->get();
       return responseJson(1,'success',$restaurants);
	}

	public function products()
	{
		$products = Product::paginate(5);

		return responseJson(1, 'success', $products);
	}

	public function reviews(Request $request)
	{
		$reviews = Review::where('restaurant_id', $request->restaurant_id)->paginate(5);

		return responseJson(1, 'success', $reviews);
	}

	public function aboutRestaurant(Request $request)
	{
		$restaurant = Restaurant::where('id', $request->restaurant_id)->get();

		return responseJson(1, 'success', $restaurant);
	}

	public function contacts()
	{
		$contacts = Contact::all();

		return responseJson(1, 'success', $contacts);
	}

	public function offers()
	{
		$offers = Offer::paginate(5);

		return responseJson(1, 'success', $offers);
	}

	public function settings()
	{
		$settings = Setting::find(1);

		return responseJson(1, 'success', ['about_us' => $settings->about_us]);
	}

	public function paymentMethod()
	{
		$paymentMethod = PaymentMethod::all();

		return responseJson(1, 'success', $paymentMethod);
	}
}	
