<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class FilterModel extends Model
{
    use HasFactory;

    public function index($request, $arr)
    {
        $newsArr = $arr;
        foreach($request->all() as $key => $val){
            if(method_exists($this, $method = $key . "Filter")){
                $newsArr = $this->$method($newsArr, $val);
            }
        }
        if(!$request->has("date")) $newsArr = $this->dateFilter($arr, "");
        return $newsArr;
    }

    public function hashtagFilter($arr, $value)
    {
        foreach($arr as $key => $val){
            if (!Str::of($val["title"])->is("*" . $value . "*") 
                && !Str::of(collect($val["hashtags"])->implode(' '))->is("*" . $value . "*") 
            ) { 
                $arr = Arr::except($arr, [$key]);
            }
        }
        return $arr;
    }

    public function dateFilter($arr, $value)
    {
        if($arr->count() > 1){
            if($value === "oldest") return collect($arr)->sortBy('date')->all();
            return array_reverse(collect($arr)->sortBy('date')->all());
        }
        return $arr;
        
    }
}
