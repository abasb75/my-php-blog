<?php 

namespace App\Views\Home;

use App\Models\Post;
use App\Views\General\Icon;
use App\Views\General\Style;

class Blog{

    static function posts(){
        $posts = Post::getLatestPost();
        $res = "";
        foreach($posts as $post){
            $id = $post['id'];
            $slug = $post['slug'];
            $title = $post['title'];
            $image = $post['th-image'];
            $description = $post['description'];
            $timing = $post['timing'];
            $res .= <<<HTML
            <article class="item">
                <a href="/blog/$id/$slug" title="$title" >
                    <div class="article">
                        <div class="thum-holder">
                            <img src="$image" alt="$title">
                        </div>
                        <div class="post-title">
                            <h3>$title</h3>
                            <p>$description</p>
                        </div>
                        <div class="detail">
                            <i class="icon-clock"></i>
                            <span>$timing</span>
                        </div>
                    </div>
                </a>
            </article>
HTML;
        }
        return $res;
    }
    static function render(){
        Style::require('home.blog');
        $sectionTitle = SectionTitle::render('نوشته‌های تازه');
        $posts = self::posts();
        $iconMore = Icon::render('arrow-left');

        return <<<HTML
        <div id="home-latest-post">
            <div class="content">
                $sectionTitle
                <div class="list">
                    $posts
                </div>
                <div class="button">
                    <a href="/blog">
                        <span>موارد بیشتر</span>
                        $iconMore
                    </a>
                </div>
            </div>
        </div>
HTML;
    }
}
