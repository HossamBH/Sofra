<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::where(function($q)use($request)
        {
            if($request->input('status'))
            {
               $q->where('status','like','%'.$request->status.'%');
            }

            if($request->input('id'))
            {
               $q->where('id',$request->id);
            }
            
            if (request()->input('restaurant_id'))
            {
                $q->where('restaurant_id', request()->restaurant_id);
            }
        })->latest()->paginate(20);
        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('orders.show', compact('order'));
    }
}
