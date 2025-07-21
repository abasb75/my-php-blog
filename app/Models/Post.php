<?php 
namespace App\Models;

use Abasb75\JDF\JDF;
use App\CMS\Asset;
use App\Models\Model;

class Post extends Model{
    private $table="posts";

    static function getAll(){
        $query = "SELECT * FROM `posts` WHERE `type` > 0;";
        $connect = self::connectDB();
        $res = $connect->query($query);
        $result = [];
        while($r = $res->fetch_assoc()){
            $r['slug'] = self::createSlug($r['title']);
            $r['timing'] = self::getTiming($r['create_at']);
            $r['th-image'] = Asset::image('post/'.$r['id'].'/th-'.$r['image']);
            $r['image'] = Asset::image('post/'.$r['id'].'/'.$r['image']);
            $result[]=$r;
        }
        return $result;
    }

    static function getLatestPost(){
        $query = "SELECT * FROM `posts` WHERE `type` > 0 ORDER BY `id` DESC LIMIT 3;";
        $connect = self::connectDB();
        $res = $connect->query($query);
        $result = [];
        while($r = $res->fetch_assoc()){
            $r['slug'] = self::createSlug($r['title']);
            $r['timing'] = self::getTiming($r['create_at']);
            $r['th-image'] = Asset::image('post/'.$r['id'].'/th-'.$r['image']);
            $r['image'] = Asset::image('post/'.$r['id'].'/'.$r['image']);
            $result[]=$r;
        }
        return $result;
    }

    static function getById($id){
        $sql = "SELECT * FROM `posts` WHERE `id`=?;";
        $connect = self::connectDB();
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $r = $stmt->get_result();
        if($r and $result=$r->fetch_assoc() ){
            $result['slug'] = self::createSlug($result['title']);
            $result['timing'] = self::getTiming($result['create_at']);
            $result['th-image'] = Asset::image('post/'.$result['id'].'/th-'.$result['image']);
            $result['image'] = Asset::image('post/'.$result['id'].'/'.$result['image']);
            return $result;
        }
        return false;

    }

    static function getByPage($pageNumber){
        $numPerPage = 21;
        $startIndex = ($pageNumber-1)*$numPerPage;
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM `posts` WHERE `type`>0 ORDER BY `id` DESC LIMIT $startIndex,$numPerPage;";
        $connect = self::connectDB();
        $res = $connect->query($sql);

        $posts = [];
        while($r = $res->fetch_assoc()){
            $r['slug'] = self::createSlug($r['title']);
            $r['timing'] = self::getTiming($r['create_at']);
            $r['th-image'] = Asset::image('post/'.$r['id'].'/th-'.$r['image']);
            $r['image'] = Asset::image('post/'.$r['id'].'/'.$r['image']);
            $posts[]=$r;
        }

        $totalPage = 1;
        $sql = "SELECT FOUND_ROWS() as count";
        $postCountInfo = $connect->query($sql);
        if($result = $postCountInfo->fetch_assoc()){
            $totalPage = (int)$result['count'] / $numPerPage;
            if( (int)$result['count'] % $numPerPage > 0 ){
              $totalPage = (int)$totalPage + 1;
            }
        }

        return [
            'page'=>$pageNumber,
            'lastPage'=>$totalPage,
            'posts'=>$posts,
        ];
    }

    static function getTiming($time){
        $time = explode(' ',$time)[0];
        $time = explode('-',$time);
        $shamsi = JDF::gregorian_to_jalali($time[0],$time[1],$time[2]);
        $month = [
            'فروردین','اردیبهشت','خرداد',
            'تیر','مرداد','شهریور',
            'مهر','آبان','آذر',
            'دی','بهمن','اسفند',
        ];
        $shamsi[1] = $month[$shamsi[1]-1];
        return "$shamsi[2] $shamsi[1] $shamsi[0]";
    }

    static function createSlug($title){
        $title = str_replace(" ","-",$title);
        $title = preg_replace("#[\-]+#","-",$title);
        return $title;
    }


}