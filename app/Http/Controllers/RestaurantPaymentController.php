<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commission;

class RestaurantPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $models = Commission::where(function($q)use($request)
        {
            if (request()->input('restaurant_id'))
            {
                  $q->where('restaurant_id', request()->restaurant_id);
            }

            if($request->input('payment_date'))
            {
               $q->where('payment_date',$request->payment_date);
            }

        })->latest()->paginate(20);
        return view('restaurantPayments.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('restaurantPayments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'restaurant_id' => 'required',
            'paid' => 'required',
            'payment_date' => 'required'
        ];

        $message = [
            'restaurant_id.required' => 'Restaurant is required',
            'paid.required' => 'Paid is required',
            'payment_date.required' => 'Date is required',
        ];
        $this->validate($request,$rules,$message);

        $model = Commission::create($request->all());

        flash()->success('Success');
        return redirect(route('restaurant-payments.index'));
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
        $model = Commission::findOrFail($id);
        return view('restaurantPayments.edit', compact('model'));
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
        $rules = [
            'restaurant_id' => 'required',
            'paid' => 'required',
            'payment_date' => 'required'
        ];

        $message = [
            'restaurant_id.required' => 'Restaurant is required',
            'paid.required' => 'Paid is required',
            'payment_date.required' => 'Date is required',
        ];
        $this->validate($request,$rules,$message);

       $model = Commission::findOrFail($id);
       $model->update($request->all());
       flash()->success('updated'); 
       return redirect(route('restaurant-payments.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Commission::findOrFail($id);
        $model->delete();
        flash()->success('Deleted'); 
       return back();
    }
}
