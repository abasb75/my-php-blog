<?php 
namespace App\Models;
use App\Models\Model;

class Job extends Model{
    private $table="jobs";

    static function createTable(){
        $query = "CREATE TABLE `jobs` (
            `id` int NOT NULL,
            `suitcase` varchar(32) NOT NULL,
            `duration` varchar(32) NOT NULL,
            `organ` varchar(32) NOT NULL,
            `intro` text NOT NULL,
            `image` varchar(64) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
          
        ALTER TABLE `jobs` ADD PRIMARY KEY (`id`);

          ALTER TABLE `jobs` MODIFY `id` int NOT NULL AUTO_INCREMENT;
        ";
        
        $connect = self::connectDB();
        $x = $connect->query($query);
        $connect->close();
        return $x;
    }

    static function selectAll(){
        $query = "SELECT * FROM `jobs`;";
        $connect = self::connectDB();
        $res = $connect->query($query);
        $result = [];
        while($r = $res->fetch_assoc()){
            $result[] = $r;
        }
        return $result;
    }


}