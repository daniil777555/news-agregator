<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class ParseLinks extends Model
{
    use HasFactory;

    protected $collection = "parseLinks";


    protected $array;

    public function getArray()
    {   
        if(empty($this->array)) $this->setArray();
        return $this->array;
    }

    protected function setArray()
    {
        $this->array = self::all();
    }

    public function addLink($url)
    {
        self::insert($url);
    }

    protected function deleteCollection()
    {
        foreach(self::all() as $el){
            $el->delete();
        }
    }
}
