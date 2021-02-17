<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Config;


class NewsController extends Controller
{


    public function index(Request $request)
    {
        return view("home", [
            "news" => $this->filtrByDate($request, $this->filtrByHashtag($request, Config::get("newsArray"))),
        ]);
    }


                //It will be in model
    public function filtrByHashtag($request, $arr)
    {
        if($request->has("hashtag")){
            foreach($arr as $key => $val){
                if(!Str::is($request->hashtag, $val["title"]) && !Str::contains($request->hashtag, $val["hashtags"])){ 
                    $arr = Arr::except($arr, [$key]);
                }
            }
        }
        
        return $this->filtrByDate($request, $arr);
    }

    public function filtrByDate($request, $arr)
    {
        if(count($arr) > 0){
            if($request->sortDate === "oldest") return collect($arr)->sortBy('date')->all();
            return array_reverse(collect($arr)->sortBy('date')->all());
        }
        return $arr;
        
    }
}
