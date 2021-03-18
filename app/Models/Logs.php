<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;

    protected $collection = "logs";

    protected $array = [];

    public function getArray()
    {   
        if(empty($this->array)) $this->setArray();
        return $this->array;
    }

    protected function setArray()
    {
        $this->array = self::all();
    }

    protected function deleteCollection()
    {
        foreach(self::all() as $el){
            $el->delete();
        }
    }

}
