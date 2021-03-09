<?php

namespace App\Http\Controllers;

use \App\Http\Requests\AddNewsRequest;
use \App\Http\Requests\ChangeNewsRequest;
use \App\Http\Requests\AdminLoginRequest;
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


    public function login(AdminLoginRequest $request)
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
    public function store(AddNewsRequest $request, DataBaseModel $DBModel)
    {
        $data = $request->validated()->only("title", "newBody", "date");
        $data["hashtags"] = explode(" " , $request->validated()->hashtags);
        $data["images"] = [];
        //to do: adding image (work with file system)
        $DBModel->addNews($data);
        return back()->with("success", "All is fine");
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
    public function update(ChangeNewsRequest $request, DataBaseModel $DBModel, $id)
    {
        $data = $request->validated()->only("title", "newBody", "date");
        $data["hashtags"] = explode(" " , $request->validated()->hashtags);
        //to do: adding image (work with file system)
        $DBModel->updateNews($id, $data);
        return back()->with("success", "All is fine");
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

    public function deleteImg($elId, $imgId, DataBaseModel $DBModel)
    {
        $DBModel->deleteImg($elId, $imgId);
        return back();
    }

    public function upload()
    {
        return view("administration.admUploadStrangeNews");
    }

}
