<?php 

namespace App\Views\Blog;

use App\Views\General\Style;

class Pager{

    static function pages($page,$lastPage){
        

        $res = "";
        for($i=1;$i<=$lastPage;$i++){
            $class = ($i==$page)?'active':'';
            $title = "نوشته‌های عباس باقری".($i>1?" - صفحه $i":"");
            $link = "/blog".($i>1?"?page=$i":"");
            $res .= <<<HTML
            <li>
                <a href="$link" class="$class" title="$title">
                    <span>$i</span>
                </a>
            </li>
HTML;
        }
        return $res;
    }

    static function render($page,$lastPage){
        if($lastPage==1){
            return "";
        }
        Style::add('blog.pager');
        $pages = self::pages($page,$lastPage);
        return <<<HTML
        <div id="blog-pager">
            <ul>
                $pages
            </ul>
        </div>
HTML;
    }
}