<?php

namespace App\Http\Controllers;

use \App\Http\Requests\AddNewsRequest;
use \App\Http\Requests\ChangeNewsRequest;
use \App\Http\Requests\AdminLoginRequest;
use \App\Http\Requests\UploadNewsFromStrangeResourceRequest;
use App\Models\DataBaseModel;
use App\Models\AdminUsersDBModel;
use App\Models\ParseLinks;
use App\Models\Logs;
use App\Events\Login;
use App\Events\Logout;
use App\Events\InteractionWithNews;
use App\Jobs\Parsing;
use App\Services\InteractionWithImage;
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
    public function store(AddNewsRequest $request, DataBaseModel $DBModel, Logs $logs, InteractionWithImage $interactionWithImage)
    {
        $data = collect($request->validated())->only("title", "newBody", "date")->toArray();
        $data["hashtags"] = explode("|" , $request->hashtags);

        if(!is_null($interactionWithImage->storeImage($request)))
            $data["images"] = [$interactionWithImage->storeImage($request)];
        else  $data["images"] = [];

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
                "oneNews" => $DBModel->getArray()[$id],
                "hashtag" => implode("|", $DBModel->getArray()[$id]["hashtags"]),
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
    public function update(ChangeNewsRequest $request, DataBaseModel $DBModel, $id, Logs $logs, InteractionWithImage $interactionWithImage)
    {
        $data = collect($request->validated())->only("title", "newBody", "date")->toArray();
        $data["hashtags"] = explode("|" , $request->hashtags);

        if(!is_null($interactionWithImage->storeImage($request)))
            $data["images"] = [$interactionWithImage->storeImage($request)];
        else  $data["images"] = [];

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
    public function destroy($id, DataBaseModel $DBModel, Request $request, Logs $logs, InteractionWithImage $interactionWithImage)
    {
        $news = $DBModel::find($id);
        $DBModel->deleteNews($id);
        $interactionWithImage->deleteImages($news->images);
        event(new InteractionWithNews($logs, $request->ip(), $news->title, "Delete"));
    }

    public function deleteImg($elId, $imgId, DataBaseModel $DBModel, Request $request, Logs $logs, InteractionWithImage $interactionWithImage)
    {
        $news = $DBModel::find($elId);
        $DBModel->deleteImg($elId, $imgId);
        $interactionWithImage->deleteImage($news->images[$imgId]);
        event(new InteractionWithNews($logs, $request->ip(), $news->title, "Delete image"));
        return back();
    }

    public function addLinkForParserPage()
    {
        return view("administration.admUploadStrangeNews");
    }

    public function storeLinkForParser(UploadNewsFromStrangeResourceRequest $request, ParseLinks $parseLinks)
    {
        $url = $request->validated();
        $parseLinks->addLink($url);
        return back()->with("success", "All is fine");
    }

    public function startParse(ParseLinks $parseLinks)
    {
        foreach($parseLinks->getArray() as $link){
            Parsing::dispatch($link["link"]);
        }
        return back()->with("success", "All is fine");
    }

}
