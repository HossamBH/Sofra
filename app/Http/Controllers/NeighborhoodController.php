<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Neighborhood;

class NeighborhoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $neighborhoods = Neighborhood::paginate(20);
        return view('neighborhoods.index', compact('neighborhoods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('neighborhoods.create');
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
            'name' => 'required',
            'city_id' => 'required'
        ];

        $message = [
            'name.required' => 'Name is required',
            'city_id.required' => 'neighborhoodneighborhood id is required'
        ];
        $this->validate($request,$rules,$message);

        $neighborhoodneighborhood = Neighborhood::create($request->all());

        flash()->success('Success');
        return redirect(route('neighborhoods.index'));
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
        $model = Neighborhood::findOrFail($id);
        return view('neighborhoods.edit', compact('model'));
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
       $model = Neighborhood::findOrFail($id);
       $model->update($request->all());
       flash()->success('updated'); 
       return redirect(route('neighborhoods.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $neighborhood = Neighborhood::findOrFail($id);
        $neighborhood->delete();
        flash()->success('Deleted'); 
       return back();
    }
}