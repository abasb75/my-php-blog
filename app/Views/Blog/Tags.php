<?php 

namespace App\Views\Blog;

use App\Views\General\Style;

class Tags{

    static function render($tags){
        if(count($tags)<1){
            return "";
        }
        Style::add('blog.tags');
        $res = "";
        foreach($tags as $tag){
            if($tag){
                $res .=  "<li>$tag</li>";
            }
        }
        return <<<HTML
        <div class="tags">
            <ul>
               $res 
            </ul>
        </div>
HTML;
    }

}