<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use \Config;

class AdminUsersDBModel extends Model
{
    use HasFactory;

    protected $collection = "adminCollection";
    protected $fillable = ["login", "pass", "status"];

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

    protected function createDB()
    {
        foreach(Config::get("adminArray") as $user)
            self::create($user);

    }

    protected function deleteCollection()
    {
        foreach(self::all() as $el){
            $el->delete();
        }
    }
}
