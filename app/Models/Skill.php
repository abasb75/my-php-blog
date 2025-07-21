<?php 

namespace App\Models;
use App\Models\Model;

class Skill extends Model{
    private $table="skills";

    static function selectAll(){
        $query = "SELECT * FROM `skills`;";
        $connect = self::connectDB();
        $res = $connect->query($query);
        $result = [];
        while($r = $res->fetch_assoc()){
            $result[] = $r;
        }
        return $result;
    }


}