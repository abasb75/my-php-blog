<?php 
namespace App\Models;

use App\Models\Model;

class Message extends Model{
    private $table="messages";

    static function add($args){
        $query = "INSERT INTO `messages`(`name`, `contact_way`, `message`) VALUES (?,?,?)";
        $connect = self::connectDB();
        $stmt = $connect->prepare($query);
        $stmt->bind_param("sss",$args['name'],$args['contact_way'],$args['message']);
        $re =  $stmt->execute();
        if($re){
            return true;
        }
        return false;
    }

}