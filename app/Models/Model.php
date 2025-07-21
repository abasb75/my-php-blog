<?php 

namespace App\Models;

use App\CMS\Env;

class Model {

    public $connect;

    static function calculateQuery($query){
        $query = explode('.',$query);
        $class = "App\\Models\\$query[0]";
        $method = $query[1];

        return $class::$method();
    }

    static function connectDB(){
        $host = Env::get('DB_HOST');
        $user = Env::get('DB_USER');
        $pass = Env::get('DB_PASSWORD');
        $name = Env::get('DB_NAME');
        $mysqli = new \mysqli($host,$user,$pass,$name);
        $mysqli->query('SET CHARSET UTF8');
        
        return $mysqli;
    }

    static function query($sql,$params){
        $connection = self::connectDB();
        $stmt = $connection->prepare($sql);
        $paramsCount = count($params);
        $stmt->bind_param("",...$params);
        $re =  $stmt->execute();
        if(!$re) return null;
        $re = $stmt->get_result();
        $result = [];
        while($r = $re->fetch_assoc()){
            $result[] = $r;
        }
        return $result;
    }
    
}