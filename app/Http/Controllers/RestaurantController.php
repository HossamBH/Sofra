<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $restaurants = Restaurant::where(function($q)use($request)
        {
            if($request->input('name'))
            {
               $q->where('name','like','%'.$request->name.'%');
            }
            
            if (request()->input('city_id'))
            {
              $q->whereHas('neighborhood', function ($q2)
              {
                  $q2->where('city_id', request()->city_id);
              });
            }

            if($request->input('phone'))
            {
               $q->where('phone','like','%'.$request->phone.'%');
            }

            if($request->input('status'))
            {
               $q->where('status',$request->status);
            }

        })->latest()->paginate(20);
        return view('restaurants.index', compact('restaurants'));
    }

    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('restaurants.show', compact('restaurant'));
    }


    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();
        flash()->success('Deleted'); 
       return back();
    }

    public function activate($id)

    {

        $restaurant = Restaurant::findOrFail($id);
        $restaurant->activated = 1;
        $restaurant->save();
        flash()->success('activated');
        return back();

    }

    public function deActivate($id)

    {

        $restaurant = Restaurant::findOrFail($id);
        $restaurant->activated = 0;
        $restaurant->save();
        flash()->success('De-Activated');
        return back();

    }
}
