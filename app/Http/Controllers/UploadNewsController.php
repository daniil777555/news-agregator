<?php

namespace App\Http\Controllers;

use App\Models\DataBaseModel;
use Illuminate\Support\Facades\Http;

class UploadNewsController extends Controller
{

    public $response;

    public function index(DataBaseModel $DBnewsModel)
    {
        $this->response = collect(Http::get
            ("https://api.nytimes.com/svc/topstories/v2/home.json?api-key=FWCJLcQSc23edDEAt32DYAjtEaft2eqA")
                ->json());
        $this->store($DBnewsModel);
    }

    public function store(DataBaseModel $DBnewsModel)
    {
        foreach($this->response["results"] as $news){
            $data["images"] = [$news["multimedia"][0]["url"]];
            $data["title"] = $news["title"];
            $data["newBody"] = $news["abstract"];
            $data["created_by"] = $news["byline"];
            $data["url"] = $news["url"];
            $data["hashtags"] = $news["des_facet"];
            $data["date"] = $news["published_date"];
            $DBnewsModel->addNews($data);
        }
    }
}
