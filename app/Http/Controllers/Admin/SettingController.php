<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\SettingFormRequest;

class SettingController extends Controller
{
    public function index(){
        $setting = Setting::first();
      return view('admin.setting.index',compact('setting'));
    }

    public function store(SettingFormRequest $request){
        $setting = Setting::first();
        $validatedData =$request->validated();
        if($setting){
            $setting->update([
                $setting->website_name=$validatedData['website_name'],
                $setting->website_url=$validatedData['website_url'],
                $setting->page_title=$validatedData['page_title'],
                $setting->meta_keyword=$validatedData['meta_keyword'],
                $setting->meta_description=$validatedData['meta_description'],
                $setting->address=$validatedData['address'],
                $setting->phone=$validatedData['phone'],
                $setting->email=$validatedData['email'],
                $setting->facebook=$validatedData['facebook'],
                $setting->twitter=$validatedData['twitter'],
                $setting->instagram=$validatedData['instagram'],
            ]);
            return redirect()->back()->with('message',Config::get('variables.SUCCESS_MESSAGES.UPDATED_SETTING'));
        }else{
            $setting=new Setting();
            $setting->create([
                $setting->website_name=$validatedData['website_name'],
                $setting->website_url=$validatedData['website_url'],
                $setting->page_title=$validatedData['page_title'],
                $setting->meta_keyword=$validatedData['meta_keyword'],
                $setting->meta_description=$validatedData['meta_description'],
                $setting->address=$validatedData['address'],
                $setting->phone=$validatedData['phone'],
                $setting->email=$validatedData['email'],
                $setting->facebook=$validatedData['facebook'],
                $setting->twitter=$validatedData['twitter'],
                $setting->instagram=$validatedData['instagram'],
            ]);
            return redirect()->back()->with('message',Config::get('variables.SUCCESS_MESSAGES.CREATED_SETTING'));


        }


    }
}
