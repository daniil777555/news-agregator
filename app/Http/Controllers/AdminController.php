<?php

namespace App\Http\Controllers;

use \App\Http\Requests\AddNewsRequest;
use \App\Http\Requests\ChangeNewsRequest;
use \App\Http\Requests\AdminLoginRequest;
use App\Models\DataBaseModel;
use App\Models\AdminUsersDBModel;
use App\Models\Logs;
use App\Events\Login;
use App\Events\Logout;
use App\Events\InteractionWithNews;
use Illuminate\Http\Request;

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


    public function loginPage()
    {
        return view("administration.admLogin");
    }

    public function login(AdminLoginRequest $request, AdminUsersDBModel $AdmUserDB, Logs $logs)
    { 
        foreach ($AdmUserDB->getArray() as $el) {
            if ($el->login === $request->validated()["login"] 
                && $el->pass === $request->validated()["pass"]) {
                session(["login" => $request->login, "status" => str_split($el->status)]);
                event(new Login($logs, $request->ip()));
                return redirect()->route("administration.index");
            }
        }
    }

    public function logout(Request $request, Logs $logs)
    {
        event(new Logout($logs, $request->ip()));
        session()->forget(['login', 'status']);
        return redirect()->route("administration.login");
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
     * @param  \App\Http\Requests\AddNewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddNewsRequest $request, DataBaseModel $DBModel, Logs $logs)
    {
        $data = collect($request->validated())->only("title", "newBody", "date")->toArray();
        $data["hashtags"] = explode(" " , $request->hashtags);
        $data["images"] = [];
        //to do: adding image (work with file system)
        $DBModel->addNews($data);
        event(new InteractionWithNews($logs, $request->ip(), $data["title"] ,"Store"));
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
                "hashtag" => implode(" ", $DBModel->getArray()[$id]["hashtags"]),
            ]);
        }
    }

    public function showLogs(Logs $logs)
    {
        return view("administration.admLogsPanel", ["logs" => $logs->getArray()->toArray()]);
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
     * @param  \App\Http\Requests\ChangeNewsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChangeNewsRequest $request, DataBaseModel $DBModel, $id, Logs $logs)
    {
        $data = collect($request->validated())->only("title", "newBody", "date")->toArray();
        $data["hashtags"] = explode(" " , $request->hashtags);
        //to do: adding image (work with file system)
        $DBModel->updateNews($id, $data);
        event(new InteractionWithNews($logs, $request->ip(), $data["title"] ,"Update"));
        return back()->with("success", "All is fine");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DataBaseModel $DBModel, Request $request, Logs $logs)
    {
        $title = $DBModel::find($id)->title;
        $DBModel->deleteNews($id);
        event(new InteractionWithNews($logs, $request->ip(), $title, "Delete"));
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
