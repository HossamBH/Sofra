<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Auth;
use App\Models\Restaurant;
use App\Models\Product;
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
			'name' => 'required|unique:clients,name' . $request->user()->id,
			'phone' => 'required',
			'password' => 'required|confirmed',
			'email' => 'required|unique:clients,email'. $request->user()->id,
			'neighborhood_id' => 'required',
		]);

		if ($validator->fails())
		{
			return responsejson(0,$validator->errors()->first(),$validator->errors());
		}

		$profile = $request->user();

		$request->merge(['password' => bcrypt($request->password)]);
		$update = $request->user()->update($request->all());
		return responsejson(1, 'success', $profile);
	}

	public function newOrder(Request $request)
	{
		$validator = validator()->make($request->all(),[
			'restaurant_id' => 'required|exists:restaurants,id',
			'product.*.product_id' => 'required|exists:products,id',
			'product.*.quantity' => 'required',
			'address' => 'required',
			'payment_method_id' => 'required|exists:payment_methods,id',
		]);

		if ($validator->fails())
		{
			return responsejson(0,$validator->errors()->first(),$validator->errors());
		}

		$restaurant = Restaurant::find($request->restaurant_id);

		if($restaurant->status == 'closed')
		{
			return responsejson(1, 'المطعم مغلق');
		}

		$order = $request->user()->orders()->create([
			'restaurant_id' => $request->restaurant_id,
			'notes' => $request->notes,
			'order_state' => 'pending',
			'address' => $request->address,
			'payment_method_id' => $request->payment_method_id,
		]);

		$price = 0;
		$delivery = $restaurant->delivery;

		foreach ($request->product as $i)
		{
			$product = Product::find($i['product_id']);

			$readyProduct = [
				$i['product_id'] => [
					'quantity' => $i['quantity'],
					'price' => $product->price,
					'notes' =>(isset($i['notes'])) ? $i['notes'] : ''
				]
			];

			$order->products()->attach($readyProduct);
			$price += ($product->price * $i['quantity']);  
		}

		if ($price >= $request->min_charge)
		{
			$total_price = $price + $delivery;
			$settings = Setting::find(1);
			$commission = $settings->commission * $price;
			$net = $total_price - $settings->commission;
			$update = $order->update([
				'price' => $price,
				'delivery' => $delivery,
				'total_price' => $total_price,
				'commission' => $commission,
				'net' => $net,
			]);

			$notification = $restaurant->notifications()->create([
                'title' => 'لديك طلب جديد',
                'content' => 'لديك طلب جديد من العمليل ' . $request->user()->name,
                'order_id' => $order->id
            ]);

            $tokens = $restaurant->tokens()->where('token', '!=', '')->pluck('token')->toArray();
            if (count($tokens)) {
                $title = $notification->title;
                $body = $notification->content;
                $data = [
                    'order_id' => $order->id
                ];
                $send = notifyByFirebase($title, $body, $tokens, $data);

			
				$data = [
					'order' => $order->fresh()->load('products')
				];

				return responseJson(1, 'success', $data);
		}
		else
		{
			$order->items()->delete();
			$order->delete();
			return responseJson(1, 'الطلب اقل من'. $restaurant->min_charge . 'جنية' );
		}
	}
}
	public function orderDetails(Request $request)
	{
		$order = $request->user()->orders()->find($request->id);

		if($order)
		{
			return responsejson(1, 'success', $order->load('products'));
		}
		return responsejson(0, 'errors');
	}

	public function pastOrders(Request $request)
	{
		$order = $request->user()->orders()->whereIn('order_state', ['rejected', 'delivered', 'declined'])->get();

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

	public function declinedOrders(Request $request)
	{
		$order = $request->user()->orders()->find($request->id);
		if ($order->order_state == 'pending' || $order->order_state == 'accepted')
		{
            $orders = $order->update([
                'order_state' => 'declined'
            ]);
            $restaurant = $order->restaurant;
            $notification = $restaurant->notifications()->create([
                'title' => 'تمت رفض الطلب',
                'content' => 'تمت رفض الطلب من المستخدم ' . $request->user()->name,
                'order_id' => $request->id
            ]);

            $tokens = $restaurant->tokens()->where('token', '!=', '')->pluck('token')->toArray();

            if (count($tokens)) {
                $title = $notification->title;
                $body = $notification->content;
                $data = [
                    'order_id' => $order->name
                ];
                $send = notifyByFirebase($title, $body, $tokens, $data);
            }

            $data = [
                'order' => $order->fresh()->load('products')
            ];
            
            return responseJson(1, 'تم الطلب بنجاح',$data);
		}
		return responsejson(0, 'error');
	}

	public function deliveredOrders(Request $request)
	{
		$order = $request->user()->orders()->find($request->id);
		if ($order->order_state == 'pending' || $order->order_state == 'accepted')
		{
            $orders = $order->update([
                'order_state' => 'delivered'
            ]);
            $restaurant = $order->restaurant;
            $notification = $restaurant->notifications()->create([
                'title' => 'تمت استلام الطلب',
                'content' => 'تمت استلام الطلب من المستخدم ' . $request->user()->name,
                'order_id' => $request->id
            ]);

            $tokens = $restaurant->tokens()->where('token', '!=', '')->pluck('token')->toArray();

//
            if (count($tokens)) {
                $title = $notification->title;
                $body = $notification->content;
                $data = [
                    'order_id' => $order->name
                ];
                $send = notifyByFirebase($title, $body, $tokens, $data);
            }

            $data = [
                'order' => $order->fresh()->load('products')
            ];

            return responseJson(1, 'تم الطلب بنجاح',$data);
		}
		return responsejson(0, 'error');
	}

	public function addReview(Request $request)
	{
		$validator = validator()->make($request->all(),[
			'content' => 'required',
			'restaurant_id' => 'required',
			'rate' => 'required',
		]);

		if ($validator->fails())
		{
			return responsejson(0,$validator->errors()->first(),$validator->errors());
		}

		$review = $request->user()->reviews()->create($request->all());

		return responsejson(1, 'success', $review);
	}
}

