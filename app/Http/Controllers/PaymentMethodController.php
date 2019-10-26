<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::paginate(20);
        return view('paymentMethods.index', compact('paymentMethods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paymentMethods.create');
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
            'type' => 'required',
        ];

        $message = [
            'type.required' => 'Type is required',
        ];
        $this->validate($request,$rules,$message);

        $paymentMethods = PaymentMethod::create($request->all());

        flash()->success('Success');
        return redirect(route('payment-methods.index'));
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
        $model = PaymentMethod::findOrFail($id);
        return view('paymentMethods.edit', compact('model'));
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
        $model = PaymentMethod::findOrFail($id);
        $model->update($request->all());
        flash()->success('updated'); 
        return redirect(route('payment-methods.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->delete();
        flash()->success('Deleted'); 
       return back();
    }
}
