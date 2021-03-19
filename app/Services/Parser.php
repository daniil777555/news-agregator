<?php declare(strict_types=1);

namespace App\Services;

use App\Models\DataBaseModel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class Parser
{

    public function parsing(string $url, DataBaseModel $DBnewsModel)
    {
        $response = collect(Http::get($url)->json());

        foreach($response["results"] as $news){
            if(date_format(date_create($news["published_date"]), 'd-m-Y') === date('d-m-Y')){
                $data["images"] = [$news["multimedia"][0]["url"]];
                $data["title"] = $news["title"];
                $data["newBody"] = $news["abstract"];
                $data["created_by"] = $news["byline"];
                $data["url"] = $news["url"];
                $data["hashtags"] = $news["des_facet"];
                $data["date"] = $news["published_date"];
                $DBnewsModel->addNews($data);
                Cache::pull("news");
            }
        }
    }
}
