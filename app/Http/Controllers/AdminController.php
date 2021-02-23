<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;

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
    public function show($id)
    {
        if(isset(Config::get("newsArray")[$id])){
            return view("administration.admChangeNews", [
                "new" => Config::get("newsArray")[$id],
                "hashtag" => implode(Config::get("newsArray")[$id]["hashtags"], " "),
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

    public function newsForChange()
    {
        return view("administration.admChangeNewsMain", ["news" => Config::get("newsArray")]);
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
    public function destroy($id)
    {
        dd($id);
    }

    public function upload()
    {
        return view("administration.admUploadStrangeNews");
    }

}
