<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Auth;
use App\Models\Product;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Setting;

class MainController extends Controller
{
	public function profile(Request $request)
	{
		$profile = $request->user();

		return responsejson(1, 'success', $profile);
	}

    public function editProfile(Request $request)
	{
		$validator = validator()->make($request->all(),[
			'name' => 'required|unique:restaurants,name,'.$request->user()->id,
			'phone' => 'required',
			'delivery' => 'required',
			'min_charge' => 'required',
			'image' => 'required',
			'password' => 'required|confirmed',
			'email' => 'required|unique:restaurants,email,'.$request->user()->id,
			'neighborhood_id' => 'required',
		]);

		if ($validator->fails())
		{
			return responsejson(0,$validator->errors()->first(),$validator->errors());
		}

		$profile = $request->user();

		$request->merge(['password' => bcrypt($request->password)]);
		$update = $request->user()->update($request->except('image'));
			if ($request->hasFile('image'))
			{
	        	$image = $request->image;
		    	$image_new_name = time() . $image->getClientOriginalName();
		    	$image->move('uploads/restaurants', $image_new_name);
		    	$profile->image = 'uploads/restaurants/'.$image_new_name;
		    	$profile->save();
			}


		return responsejson(1, 'success', $profile);
	}

	public function showProducts(Request $request)
	{
		$products = Product::paginate(5);

		return responsejson(1, 'success', $products);
	}

	public function createProduct(Request $request)
	{
		$validator = validator()->make($request->all(),[
			'name' => 'required',
			'ingredients' => 'required',
			'image' => 'required',
			'price' => 'required',
			'time' => 'required',
			'restaurant_id' => 'required|exists:restaurants,id',

		]);
		if ($validator->fails())
		{
			return responsejson(0,$validator->errors()->first(),$validator->errors());
		}

		$product = $request->user()->products()->create($request->all());
		
		if ($request->hasFile('image'))
		{
           $image = $request->image;
           $image_new_name = time() . $image->getClientOriginalName();
           $image->move('uploads/products', $image_new_name);
           $product->image = 'uploads/products/'.$image_new_name;
        }

		return responsejson(1, 'success', $product);
	}

	public function editProduct(Request $request)
	{
		$validator = validator()->make($request->all(),[
			'name' => 'required',
			'restaurant_id' => 'required',
			'ingredients' => 'required',
			'image' => 'required',
			'price' => 'required',
			'time' => 'required',

		]);
		if ($validator->fails())
		{
			return responsejson(0,$validator->errors()->first(),$validator->errors());
		}
		$product = $request->user();

		if ($product)
		{
			$update = $request->user()->update($request->except('image'));
			if ($request->hasFile('image'))
			{
	        	$image = $request->image;
		    	$image_new_name = time() . $image->getClientOriginalName();
		    	$image->move('uploads/products', $image_new_name);
		    	$product->image = 'uploads/products/'.$image_new_name;
		    	$product->save();
			}
		}
		
		return responsejson(1, 'success', $product);
	}

	public function deleteProduct(Request $request)
	{
		$validator = validator()->make($request->all(),[
			'id' => 'required|exists:products,id',
			
		]);
		$product = $request->user()->products()->find($request->id);

		if ($product)
		{
			$product->delete();
		}

		return responsejson(1, 'success');
	}

	public function showOffers(Request $request)
	{
		$offers = Offer::where('restaurant_id', $request->id)->paginate(5);

		return responsejson(1, 'success', $offers);
	}

	public function createOffer(Request $request)
	{
		$validator = validator()->make($request->all(),[
			'name' => 'required',
			'image' => 'required',
			'description' => 'required',
			'time' => 'required',
			'start' => 'required',
			'end' => 'required',

		]);
		if ($validator->fails())
		{
			return responsejson(0,$validator->errors()->first(),$validator->errors());
		}

		$offer = $request->user()->offers()->create($request->all());
		if ($request->hasFile('image'))
		{
           $image = $request->image;
           $image_new_name = time() . $image->getClientOriginalName();
           $image->move('uploads/offers', $image_new_name);
           $offer->image = 'uploads/offers/'.$image_new_name;
           $offer->save();
        }
		return responsejson(1, 'success', $offer);
	}

	public function editOffer(Request $request)
	{
		$validator = validator()->make($request->all(),[
			'name' => 'required',
			'image' => 'required',
			'description' => 'required',
			'start' => 'required',
			'end' => 'required',

		]);
		if ($validator->fails())
		{
			return responsejson(0,$validator->errors()->first(),$validator->errors());
		}

		$offer = $request->user()->offers()->find($request->id);
		if ($offer)
		{
			$offer->update($request->except('image'));

			if ($request->hasFile('image'))
			{
	        	$image = $request->image;
		    	$image_new_name = time() . $image->getClientOriginalName();
		    	$image->move('uploads/offers', $image_new_name);
		    	$offer->image = 'uploads/offers/'.$image_new_name;
		    	$offer->save();
			}
		}
		return responsejson(1, 'success', $offer);
	}

	public function deleteOffer(Request $request)
	{
		$validator = validator()->make($request->all(),[
			'id' => 'required|exists:offers,id',
			
		]);
		$offer = $request->user()->offers()->find($request->id);
		if ($offer)
		{
			$offer->delete();
		}

		return responsejson(1, 'success');
	}

	public function newOrders(Request $request)
	{
		$order = $request->user()->orders()->where('order_state', 'pending')->get();

		if($order)
		{
			return responsejson(1, 'success', $order);
		}
		return responsejson(0, 'errors');
	}

	public function pastOrders(Request $request)
	{
		$order = $request->user()->orders()->whereIn('order_state', ['delivered', 'declined'])->get();

		if($order)
		{
			return responsejson(1, 'success', $order);
		}
		return responsejson(0, 'errors');
	}

	public function currentOrders(Request $request)
	{
		$order = $request->user()->orders()->where('order_state', 'accepted')->get();

		if($order)
		{
			return responsejson(1, 'success', $order);
		}
		return responsejson(0, 'errors');
	}

	public function acceptedOrders(Request $request)
	{
		$order = $request->user()->orders()->find($request->id);
        if ($order->order_state == 'pending') {
            $orders = $order->update([
                'order_state' => 'accepted'
            ]);

            $client = $order->client;
            $notification = $client->notifications()->create([
                'title' => 'تمت الموافقه على الطلب',
                'content' => 'تمت الموافقه على الطلب من المطعم ' . $request->user()->name,
                'order_id' => $request->id,
            ]);

            $tokens = $client->tokens()->where('token', '!=', '')->pluck('token')->toArray();
            $send = null;
            if (count($tokens)) {
                $title = $notification->title;
                $body = $notification->content;
                $data = [
                    'order_id' => $order->id
                ];
                $send = notifyByFirebase($title, $body, $tokens, $data);

            }

            $data = [
                'order' => $order->fresh()->load('products')
            ];

            return responseJson(1, 'تم الطلب بنجاح', ['data' => $data, 'send' => $send]);
        }
        return responseJson(0, 'هذا الطلب لا يمكن رفضه');
	}

	public function rejectedOrders(Request $request)
	{
		$order = $request->user()->orders()->find($request->id);
        if ($order->order_state == 'pending') {
            $orders = $order->update(['order_state' => 'rejected']);

            $client = $order->client;
            $notification = $client->notifications()->create([
                'title' => 'تمت رفض الطلب',
                'content' => 'تمت رفض الطلب من المطعم ' . $request->user()->name,
                'order_id' => $request->id,
            ]);
            $send = null;
            $tokens = $client->tokens()->where('token', '!=', '')->pluck('token')->toArray();
            if (count($tokens)) {
                $title = $notification->title;
                $body = $notification->content;
                $data = [
                    'order_id' => $order->id
                ];
                $send = notifyByFirebase($title, $body, $tokens, $data);

            }

            $data = [
                'order' => $order->fresh()->load('products')
            ];

            return responseJson(1, 'تم الطلب بنجاح', ['data' => $data, 'send' => $send]);
        }
        return responseJson(0, 'هذا الطلب لا يمكن رفضه');
	}

	public function settings(Request $request)
	{
		$settings = Setting::find(1);
		$price = $request->user()->orders()->where('order_state', 'delivered')->sum('price');
		$commission = $price * 0.1;
		$paid = $request->user()->commissions()->sum('paid');
		$remain = $commission - $paid;
		return responsejson(1, 'success', [
			'content' => $settings->content,
			'text' => $settings->text,
			'Total' => $price,
			'commission' => $commission,
			'paid' => $paid,
			'remain' => $remain,
		]);
	}
}
