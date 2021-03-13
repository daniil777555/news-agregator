<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Jenssegers\Mongodb\Eloquent\Model;
use \Config;

class DataBaseModel extends Model
{
    use HasFactory;

    protected $collection = "news";
    protected $fillable = ["images", "title", "newBody", "hashtags", "date"];
    public $timestamps = false;

    protected $array = [];

    public function getArray()
    {   
        if(empty($this->array)) $this->setArray();
        return $this->array;
    }

    protected function setArray()
    {
        if(self::all()->isEmpty()) $this->createDB();

        $this->array = self::all();
    }

    public function updateNews($id, $data)
    {
        self::find($id)->fill($data)->save();
    }

    protected function createDB()
    {
        foreach(Config::get("newsArray") as $news)
            self::create($news);

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
        $this->setArray();
    }

    public function deleteImg($elId, $imgId)
    {
        $imgArr = self::find($elId)->images;
        array_splice($imgArr, $imgId, 1);
        self::find($elId)->update(["images" => $imgArr]);
    }
}
