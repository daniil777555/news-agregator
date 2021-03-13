<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataBaseModel;
use App\Models\FilterModel;


class NewsController extends Controller
{


    public function index(Request $request, DataBaseModel $DBModel, FilterModel $filter)
    {
        return view("home", [
            "news" => $filter->index($request, $DBModel->getArray()),
        ]);
    }
    
}
