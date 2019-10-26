<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
class OfferController extends Controller
{
    public function index(Request $request)
    {
        $offers = offer::where(function($q)use($request)
        {
            if($request->input('name'))
            {
               $q->where('name','like','%'.$request->name.'%');
            }
            
            if (request()->input('restaurant_id'))
            {
                $q->where('restaurant_id', request()->restaurant_id);
            }

        })->latest()->paginate(20);
        return view('offers.index', compact('offers'));
    }


    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->delete();
        flash()->success('Deleted'); 
       return back();
    }
}
