<?php 

namespace App\Views\WorkSamples;

use App\Views\Blog\Pager;
use App\Views\General\Heading;
use App\Views\General\Icon;
use App\Views\General\Style;
use App\Views\Home\SectionTitle;

class WorkSampleList{

    static function render($args){
        $posts = $args['posts'];
        $page = $args['page'];
        $lastPage = $args['lastPage'];

        $title = ($page==1)?"جدیدترین نوشته‌ها":"جدیدترین نوشته‌ها - صفحه $page";
        $sectionTitle = SectionTitle::render($title);

        Style::require('blog.list');
        $heading = Heading::render($args['heading']['title'],$args['heading']['description']);
        $posts = self::posts($posts);
        $pager = Pager::render($page,$lastPage);
    
        return <<<HTML
        $heading
        <div id="blog-list">
            <div class="content">
                <div class="section-title-container">
                    $sectionTitle
                </div>
                <section id="blog-section">
                    $posts
                </section>
                $pager
            </div>
        </div>
HTML;
    }

    static function posts($posts){
        $iconClock = Icon::render('clock');
        $res = "";
        foreach($posts as $post){
            $id = $post['id'];
            $slug = $post['slug'];
            $title = $post['title'];
            $thImage = $post['th-image'];
            $description = $post['description'];
            $timing = $post['timing'];
            $res .= <<<HTML
            <article class="item">
                <a href="/work-samples/$id/$slug" title="$title" >
                    <div class="article">
                        <div class="thum-holder">
                            <img 
                            src="$thImage" 
                            alt="$title" 
                            width="300" height="200"
                            />
                        </div>
                        <div class="article-info">
                            <div class="post-title">
                                <h3>$title</h3>
                                <p>$description</p>
                            </div>
                            <div class="detail">
                                $iconClock
                                <span>$timing</span>
                            </div>
                        </div>
                    </div>
                </a>
            </article>
HTML;
        }
        return $res;
    }

    

}