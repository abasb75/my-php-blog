<?php 

namespace App\Controllers;

use App\CMS\Response;
use App\Models\Post;
use DateTime;

class SiteMapController{

    function xml(){
        $_MAIN_URL = 'https://abasbagheri.ir';
        $xml = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';
        $xml .=  "<url><loc>$_MAIN_URL/blog</loc><changefreq>weekly</changefreq><priority>1</priority></url>";
        $posts = Post::getAll();
        $pageCount = ceil(count($posts)/21);
        for($i=2;$i<=$pageCount;$i++){
            $xml .=  "<url><loc>$_MAIN_URL/blog?page=$i</loc><changefreq>weekly</changefreq><priority>1</priority></url>";
        }

        foreach ($posts as $i=>$post){
            $date = $post['create_at'];
            $date = explode(' ', $date);
            $date = explode('-',$date[0]);
            $Y = $date[0];
            $m = $date[1];
            $d = $date[2];
            $slug = 'blog/';
            if($post['type']=='2'){
                $slug = 'project/';
            }
            $slug .= $post['id'].'/';
            $slug .= str_replace(' ','-',$post['title']);

            $image = $_MAIN_URL.$post['image'];
            $xml .= "<url><loc>$_MAIN_URL/$slug</loc><lastmod>$Y-$m-$d</lastmod><changefreq>never</changefreq><priority>1</priority><image:image><image:loc>$image</image:loc></image:image></url>";

        }
        $xml .= '</urlset>';

        return Response::xml($xml);
    }

    function json(){
        $_MAIN_URL = 'https://abasbagheri.ir';

        /** create posts */
        $posts = Post::getAll();
        $postLinks = [];
        foreach($posts as $post){
            $date = $post['create_at'];
            $date = explode(' ', $date);
            $date = explode('-',$date[0]);
            $Y = $date[0];
            $m = $date[1];
            $d = $date[2];
            $postLinks[] = [
                'url'=>"$_MAIN_URL/blog/".$post['id']."/".$post['slug'],
                'image'=>$post['image'],
                'lastMode'=>"$Y-$m-$d",
            ];
        }

        return Response::json([
            'posts'=>$postLinks,
        ]);


    }

    function rss(){
        $xml = '<rss version="2.0">
        <channel>
          <title>Abbas Bagheri Blog</title>
          <link>https://abasbagheri.ir/</link>
          <description>Web development</description>
          <language>fa-ir</language>
          <pubDate>Tue, 10 Jun 2022 04:00:00 GMT</pubDate>
          <lastBuildDate>Tue, 10 Jun 2022 09:41:01 GMT</lastBuildDate>
          <docs>https://abasbagheri.ir/rss</docs>
          <generator>Abbas Bagheri</generator>
          <managingEditor>abasbagheria@gmail.com</managingEditor>
          <webMaster>abasbagheria@gmail.com</webMaster>';
    
        $posts = Post::getAll();
        foreach($posts as $post){
            $title = $post['title'];
            $description = $post['description'];
            $link = "https://abasbagheri.ir/blog/".$post['id']."/".$post['slug'];
            
            //Tue, 03 Jun 2003 09:39:21 GMT
            $publicDate = $post['create_at'];
            $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s',$publicDate );
            $publicDate = $myDateTime->format('D, d M Y H:i:s') . " GMT";

            $xml .="<item>
            <title>$title</title>
            <link>$link</link>
            <description>$description</description>
            <pubDate>$publicDate</pubDate>
            <guid>$link</guid>
          </item>";
        }
        $xml .= '  </channel>
        </rss>'; 

        return Response::xml($xml);


    }


}



    

