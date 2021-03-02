<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataBaseModel;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("administration.admHome");
    }


    public function login()
    {
        return view("administration.admLogin");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("administration.admAddNews");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, DataBaseModel $DBModel)
    {
        if(isset($DBModel->getArray()[$id])){
            return view("administration.admChangeNews", [
                "new" => $DBModel->getArray()[$id],
                "hashtag" => implode($DBModel->getArray()[$id]["hashtags"], " "),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function newsForChange(DataBaseModel $DBModel)
    {
        return view("administration.admChangeNewsMain", ["news" => $DBModel->getArray()]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DataBaseModel $DBModel)
    {
        $DBModel->deleteNews($id);
        return view("administration.admChangeNewsMain", ["news" => $DBModel->getArray()]);
        
    }

    public function upload()
    {
        return view("administration.admUploadStrangeNews");
    }

}
