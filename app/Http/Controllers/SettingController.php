<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return view('settings.index', compact('settings'));
    }

    public function create()
    {
        return view('settings.create');
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
            'about_us' => 'required',
            'content' => 'required',
            'text' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'fb_link' => 'required',
            'twitter_link' => 'required',
            'youtube_link' => 'required',
            'whatsapp' => 'required',
            'insta_link' => 'required',
            'commission' => 'required',
            'maximum' => 'required',
        ];

        $message = [
            'about_us.required' => 'About us is required',
            'content.required' => 'Content is required',
            'text.required' => 'Text is required',
            'phone.required' => 'Phone is required',
            'email.required' => 'Email is required',
            'fb_link.required' => 'Facebook link is required',
            'twitter_link.required' => 'Twitter link is required',
            'youtube_link.required' => 'Title is required',
            'whatsapp.required' => 'whatsapp number is required',
            'insta_link.required' => 'Instgram link is required',
            'commission.required' => 'Commission is required',
            'maximum.required' => 'Maximum is required',
        ];
        $this->validate($request,$rules,$message);

        $setting = Setting::create($request->all());

        flash()->success('Success');
        return redirect(route('settings.index'));
    }

    public function edit(Request $request, $id)
    {
        $model = Setting::findOrFail($id);
    
        return view('settings.edit', compact('model'));
    }

    public function update(Request $request, $id)
    {
    
        $rules = [
            'about_us' => 'required',
            'content' => 'required',
            'text' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'commission' => 'required',
            'maximum' => 'required',
        ];

        $message = [
            'about_us.required' => 'About us is required',
            'content.required' => 'Content is required',
            'text.required' => 'Text is required',
            'phone.required' => 'Phone is required',
            'email.required' => 'Email is required',
            'commission.required' => 'Commission is required',
            'maximum.required' => 'Maximum is required',
        ];
        $this->validate($request,$rules,$message);
        $setting= Setting::findOrFail($id);
        $setting->update($request->all());
        flash()->success('Updated');
       return redirect(route('settings.index'));
    }
}