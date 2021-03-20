<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;

use Jenssegers\Mongodb\Eloquent\Model;

class DataBaseModel extends Model
{
    use HasFactory;

    protected $collection = "news";
    protected $fillable = ["images", "title", "newBody", "hashtags", "date"];
    public $timestamps = false;


    public function getArray()
    {   
        return Cache::remember('news', 750, function () {
            return self::all();
        });

    }

    public function updateNews($id, $data)
    {
        $news = self::find($id);
        $news->title = $data["title"];
        $news->newBody = $data["newBody"];
        $news->images = array_merge($news->images, $data["images"]);
        $news->date = $data["date"];
        $news->hashtags = $data["hashtags"];
        $news->save();
    }

    public function addNews($data)
    {
        self::insert($data);
    }

    protected function deleteCollection()
    {
        foreach(self::all() as $el){
            $el->delete();
        }
    }

    public function deleteNews($id)
    {
        self::destroy($id);
    }

    public function deleteImg($elId, $imgId)
    {
        $news = self::find($elId);
        $imgArr = $news->images;
        array_splice($imgArr, $imgId, 1);
        $news->images = $imgArr;
        $news->save();
    }
}
